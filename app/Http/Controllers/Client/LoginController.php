<?php

namespace App\Http\Controllers\Client;

use App\Helper\CartHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $user = User::find(session('userID'));
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        $orders = Order::with(['user', 'orderDetails.productDetail'])
        ->select('orders.*', 'users.email as mainemail', 'totals.total')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin(
            DB::raw('(SELECT order_id, SUM(product_details.sale_price * order_details.quantity) as total
                    FROM order_details
                    INNER JOIN product_details ON order_details.product_detail_id = product_details.id
                    GROUP BY order_id) as totals'),
            'orders.id', '=', 'totals.order_id'
        )
        ->where('orders.user_id', '=', session('userID')) // Additional condition
        ->get();
        if($orders){
            return view('FE.User.index', compact('user', 'categories', 'totalQuantity', 'orders'));
        }else{
            return view('FE.User.index', compact('user', 'categories', 'totalQuantity'));
        }

    }
    public function Uimage()
    {
        $user = User::find(session('userID'));
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        return view('FE.User.update', compact('user', 'categories', 'totalQuantity'));
    }
    public function Upass(Request $request)
    {
        $user = User::find(session('userID'));
        $request->validate([
            'password_current' => 'required|min:6',
            'newpassword' => 'required|min:6',
        ],[
            'password_current.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'password_current.min' => 'Mật khẩu hiện tại phải có ít nhất :min ký tự.',
            'newpassword.required' => 'Vui lòng nhập mật khẩu mới.',
            'newpassword.min' => 'Mật khẩu mới phải có ít nhất :min ký tự.',
        ]);
        if ($request->password_current === session('password')) {
            session(['password' =>$request->newpassword]);
            $request->merge(['newpassword' => Hash::make($request->newpassword)]);
            $user->password = $request->newpassword;
            $user->save();
            return redirect()->back()->with('success', 'Thay mật khẩu thành cồng');
        }else{
            return redirect()->back()->with('success', 'Mật khẩu hiện tại không đúng');
        }
    }
    public function Uavatar(Request $request)
    {
        $user = User::find(session('userID'));
        $request->validate([
            'avatar_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'avatar_image.required' => 'Vui lòng chọn ảnh để tải lên.',
            'avatar_image.image' => 'File tải lên không phải là hình ảnh.',
            'avatar_image.mimes' => 'Chỉ chấp nhận các định dạng hình ảnh như jpeg, png, jpg, gif.',
            'avatar_image.max' => 'Kích thước tệp quá lớn, vui lòng chọn tệp nhỏ hơn 2048 KB.',
        ]);

        if ($request->hasFile('avatar_image')) {
            $imagePath = $request->file('avatar_image')->store('images', 'public');
            $user->avatar_image = 'storage/' . $imagePath;
            $user->save();
            return redirect()->back()->with('success', 'Cập nhật ảnh thành công');
        }
        return redirect()->back()->with('success', 'Cập nhật lỗi');
    }
    public function Uin4(Request $request)
    {
        $user = User::find(session('userID'));

        // Validate the request data
        $request->validate([
            'newname' => 'string',
            'newphone' => ['string', 'regex:/^(\+84|0)([0-9]{9,10})$/'],
            'newemail' => 'email',
            'newaddress' => 'string',
        ], [
            'newname.string' => 'tên không hợp lệ.',
            'newphone.string' => 'Số điện thoại không hợp lệ.',
            'newphone.regex' => 'Số điện thoại mới không hợp lệ.',
            'newemail.email' => 'Email không hợp lệ.',
            'newaddress.string' => 'Địa chỉ không hợp lệ.',
        ]);

        if ($request->filled('newname')) {
            $user->name = $request->newname;
        }
        // Update user information
        if ($request->filled('newphone')) {
            $user->phone = $request->newphone;
        }

        if ($request->filled('newemail')) {
            $user->email = $request->newemail;
        }

        if ($request->filled('newaddress')) {
            $user->address = $request->newaddress;
        }

        // Get the authenticated user
        try {
            $user->save();
            return redirect()->back()->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->back()->with('success', 'Đã xảy ra lỗi khi cập nhật thông tin người dùng.');
        }
    }
    public function Frmlogin()
    {
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        return view('FE.User.login', compact('categories' , 'totalQuantity'));
    }
    public function Frmregis()
    {
        $totalQuantity = CartHelper::getTotalQuantity();
        $categories = Category::all();
        return view('FE.User.regis', compact('categories', 'totalQuantity'));
    }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->admin == 1) {
                session(['admin' => true]);
                return redirect()->route('admin.index');
            } else {
                session(['password' =>$request->password]);
                session(['userID' => Auth::user()->id]);
                session(['name' => Auth::user()->name]);
                if(Auth::user()->phone == NULL && Auth::user()->address == NULL ){
                    return redirect()->route('user.index2');
                }else{
                    return redirect()->route('index');
                }
            }
        }
        return redirect()->back()->with('success', 'Đăng nhập thất bại.');
    }
    public function regis(RegisRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        try {
            User::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('user.login');
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('admin');
        session()->forget('userID');
        session()->forget('name');
        return redirect()->route('index');
    }
}
