@extends('layouts.app_plane')

@section('title', 'Login Page')
@section('extra_css')
    <style>
        .logo {
            width: 60px;
            height: 60px;
        }

        .btn-color {
            background: #6300db !important;
            color: #eee;
        }

        .btn-color:hover {
            background: #6300dd;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-lg-4 col-md-7 col-11">
            <form action="{{ route('login') }}" method="post" id="login-form">
                @csrf
                <div class="card">
                    <div class=" card-body">
                        @error('error')
                            {{ $message }}
                        @enderror
                        <div class="mb-4 text-center">
                            <img src="/image/logo.png" alt="" class="logo">
                        </div>
                        <div class="mb-4 form-outline">
                            <input type="email" name="email" class="form-control">
                            <label for="" class="form-label">Email</label>
                        </div>
                        <div class="mb-4 form-outline">
                            <input type="password" name="password" class="form-control">
                            <label for="" class="form-label">Password</label>
                        </div>
                        <div class="mt-5 form-outline">
                            <button type="submit" class="btn btn-block btn-color">Login</button>
                        </div>
                        <div class="mt-3 text-start">
                            <a href="{{ route('auth#registerPage') }}" class="">Do You Have Account?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\LoginForm'), 'login-form' !!}
    <script></script>
@endsection
