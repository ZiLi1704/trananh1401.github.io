@extends('Layout.FE')
@section('content')
    <section class="vh-80 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="{{ route('user.regis') }}" method="post">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color:white">Đăng Ký</h2>
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="name">Tên đầy đủ</label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"  />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="repassword">Xác nhận mật khẩu</label>
                                        <input type="password" id="repassword" name="repassword" class="form-control @error('repassword') is-invalid @enderror" />
                                        @error('repassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('user.login') }}">Đã có tài khoản </a></p>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
