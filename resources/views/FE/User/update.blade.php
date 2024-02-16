@extends('Layout.FE')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('index') }}">Trang chủ</a>
                    <span class="breadcrumb-item active">Cá nhân</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row" style="min-height: 60vh; background-color: #1a0000">
                                <table style="height: 100%; width: 100%; ">
                                    <tr style="min-height:100px">
                                        <td>
                                            <a href="{{ route('user.index2') }}"><input type="button" value="Quay lại"></a>
                                        </td>
                                        <td colspan="2" style="padding-top: 10px">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul style="list-style-type: none">
                                                        @foreach ($errors->all() as $error)
                                                            <li>
                                                                <h5 class="alert-title">{{ $error }}</h5>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if ($success = Session::get('success'))
                                                <div class="alert alert-success">
                                                    <h5 class="alert-title">{{ $success }}
                                                    </h5>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="border: 1px solid white; height: 100px">
                                        <td style="text-align: left; width: 140px; ">
                                            <h5 style="color:white">Mật khẩu: </h5>
                                        </td>
                                        <td>
                                            <form action="{{ route('user.pass') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td style="width:15%;text-align: left;">
                                                            <label for="txtpassword_current" style="color: white;">Mật khẩu
                                                                hiện tại:</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="password_current"
                                                                id="txtpassword_current" style="width: 100%"  class="form-control @error('password_current') is-invalid @enderror" >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;">
                                                            <label for="txtpassword_new" style="color: white;">Mật khẩu
                                                                mới:</label>
                                                        </td>
                                                        <td>
                                                            <input type="password" name="newpassword" id="txtpassword_new"
                                                                style="width: 100%" class="form-control @error('newpassword') is-invalid @enderror">
                                                        </td>
                                                    </tr>
                                                </table>
                                        <td style="width: 120px;text-align: right;">
                                            <button type="submit">Đổi mật khẩu</button>
                                        </td>
                                        </form>
                                        </td>

                                    </tr>
                                    <tr style="border: 1px solid white; height: 80px;">
                                        <td>
                                            <h5 style="color:white">Ảnh đại diện</h5>
                                        </td>
                                        <form action="{{route('user.avatar')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <input type="file" name="avatar_image" id="avatar_image" accept="image/*"
                                                    style="color: white">
                                            </td>
                                            <td style="text-align: right">
                                                <button type="submit">Gửi ảnh</button>
                                            </td>
                                        </form>
                                    </tr>
                                    <tr style="border: 1px solid white">
                                        <td>
                                            <h5 style="color:white">Thông tin: </h5>
                                        </td>
                                        <td>
                                            <form action="{{route('user.Uin4')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td style="width: 15%;text-align: left;">
                                                            <label style="color: white;">Tên mới: </label>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <input type="text" name="newname" style="width: 100%;" value="{{ old('newname', $user->name) }}" class="form-control @error('newname') is-invalid @enderror">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;">
                                                            <label style="color: white;">Email mới: </label>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <input type="text" name="newemail" style="width: 100%;" value="{{ old('newemail', $user->email) }}" class="form-control @error('newemail') is-invalid @enderror">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;">
                                                            <label style="color: white;">Số điện thoại mới: </label>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <input type="text" name="newphone" style="width: 100%;" value="{{ old('newphone', $user->phone) }}" class="form-control @error('newphone') is-invalid @enderror">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left;">
                                                            <label style="color: white;">Địa chỉ mới: </label>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <input type="text" name="newaddress" style="width: 100%;" value="{{ old('newaddress', $user->address) }}" class="form-control @error('newaddress') is-invalid @enderror">
                                                        </td>
                                                    </tr>
                                                </table>
                                        </td>
                                        <td style="text-align: right">
                                            <button type="submit">Cập nhật</button>
                                        </td>
                                        </form>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row" style="min-height: 60vh">
                                <div class="col-2">
                                    <img src="{{ asset($user->avatar_image) }}" style="width:100%; height:100px"
                                        alt="avatar_image">
                                    <input type="button" value="Thay ảnh đại diện">
                                    <h5>{{ $user->name }}</h5>
                                </div>
                                <div class="col-10">
                                    <div style="text-align: right">
                                        <input type="button" value="Đổi mật khẩu">
                                        <input type="button" value="Cập nhật thông tin">
                                    </div>

                                    <table style="height: 100%; width: 100%">
                                        <tr>
                                            <td style="text-align: left; width: 140px;">
                                                <h5>Email: </h5>
                                            </td>
                                            <td style="text-align: left">
                                                <h5>{{ $user->email }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <h5>Số điện thoại: </h5>
                                            </td>
                                            <td style="text-align: left;">
                                                <h5>{{ $user->phone }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <h5>Địa chỉ: </h5>
                                            </td>
                                            <td style="text-align: left">
                                                <h5>{{ $user->address }}</h5>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
