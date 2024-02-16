<?php
use App\Http\Controllers\Client\LoginController;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartSaveController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/')->group(function(){
    Route::resource('', HomeController::class);
    Route::get('shop/{id}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('product/{id}', [ShopController::class, 'GetProduct'])->name('shop.detail');
    Route::get('login', [LoginController::class, 'Frmlogin'])->name('user.login');
    Route::post('login', [LoginController::class, 'login'])->name('user.login');
    Route::get('regis', [LoginController::class, 'Frmregis'])->name('user.regis');
    Route::post('regis', [LoginController::class, 'regis'])->name('user.regis');
    Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');
    Route::get('user2', [LoginController::class, 'index'])->name('user.index2');
    Route::get('user/edit', [LoginController::class, 'Uimage'])->name('user.image');
    Route::put('user/password',[LoginController::class, 'Upass'])->name('user.pass');
    Route::put('user/avatar',[LoginController::class, 'Uavatar'])->name('user.avatar');
    Route::put('user/inf',[LoginController::class, 'Uin4'])->name('user.Uin4');
    Route::put('addCart',[CartSaveController::class, 'AddCard'])->name('cart.add');
    Route::get('card',[CartSaveController::class, 'index'])->name('cart.index');
    Route::delete('card/delete',[CartSaveController::class, 'delete'])->name('cart.delete');
    Route::put('card/update',[CartSaveController::class, 'update'])->name('cart.update');
    Route::get('checkout',[CartSaveController::class, 'checkout'])->name('cart.checkout');
    Route::post('checkout',[CartSaveController::class, 'Oder'])->name('cart.order');
    Route::get('contact',[HomeController::class, 'contact'])->name('home.contact');
    Route::post('order/ok', [OderController::class, 'ok'] )->name('od.ok');
    Route::post('order/shipErr', [OderController::class, 'shipErr2'] )->name('od.shipErr2');
});


Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    //Route User
    Route::resource('user', UserController::class);
    Route::put('/user/softdel/{id}', [UserController::class, 'softdel'])->name('user.softdel');
    Route::get('/trast', [UserController::class, 'trast'])->name('user.trast');
    Route::put('/trast/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    //Route Danh Mục
    Route::resource('category', CategoryController::class);
    Route::get('category-trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::post('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::delete('/category/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');
    //Route Bài Viết
    Route::resource('post', PostController::class);
    //Route Thương hiệu
    Route::resource('brand', BrandController::class);
    //Route Nhà cung cấp
    Route::resource('supplier', SupplierController::class);
    //Route Sản Phẩm
    Route::resource('product', ProductController::class);
    Route::resource('productimage', ProductImageController::class);
    Route::resource('productdetail', ProductDetailController::class);
    Route::get('storage', [ProductDetailController::class, 'storage'])->name('storage.index');
    Route::post('storage/edit', [ProductDetailController::class, 'storage_edit'])->name('storage.edit');
    Route::get('input', [ProductDetailController::class, 'input'])->name('storage.input');
    Route::post('storage/add', [ProductDetailController::class, 'add'])->name('storage.add');
    //Route Od
    Route::get('order', [OderController::class, 'index'])->name('od.index');
    Route::get('order/dt/{id}', [OderController::class, 'dt'])->name('od.dt');
    Route::post('order/stt/{id}', [OderController::class, 'stt'] )->name('od.stt');
    Route::post('order/drop/{id}', [OderController::class, 'drop'] )->name('od.drop');
    Route::get('order/ship', [OderController::class, 'ship'] )->name('od.ship');
    Route::post('order/ship/{id}', [OderController::class, 'shipOrder'] )->name('od.shipOrder');
    Route::post('order/unstt/{id}', [OderController::class, 'unstt'] )->name('od.unstt');
    Route::get('order/shipping', [OderController::class, 'shipping'] )->name('od.shipping');
    Route::get('order/done', [OderController::class, 'done'] )->name('od.done');
    Route::get('order/err', [OderController::class, 'err'] )->name('od.err');
    Route::post('order/shipErr/{id}', [OderController::class, 'shipErr'] )->name('od.shipErr');
});

