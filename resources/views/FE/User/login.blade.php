@extends('Layout.FE')
@section('content')
    <section class="vh-80 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="{{ route('user.login') }}" method="post">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase" style="color:white">Đăng nhập</h2>
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul style="list-style-type: none">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
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
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="text" id="typeEmailX" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                    </div>
                                    <div class="form-white mb-4" style="text-align: left">
                                        <label class="form-label" for="typePasswordX">Mật khẩu</label>
                                        <input type="password" id="typePasswordX" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" />
                                    </div>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('user.regis') }}">Chưa có tài khoản ?</a></p>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Đăng nhập</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
