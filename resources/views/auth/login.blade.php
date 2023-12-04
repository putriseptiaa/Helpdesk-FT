@extends('layouts.auth')
@section('title')
    <title>HELPDESK - LOGIN</title>
@endsection
@section('nav')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light py-4">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="../../assets/img/logounsil.png" width="30" height="30" class="d-inline-block align-top"
                    alt="HELPDESK">
                HELPDESK FAKULTAS TEKNIK
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <span class="nav-link nav-link-login">
                        <a href="{{ route('register') }}"> Register</a>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Navbar -->
@endsection 
@section('content')

<section class="my-login">
    <div class="row justify-content-center">
        <div class="card-wrapper">
            <div class="card fat">
                <div class="card-body">
                    <h4 class="card-title">Login <span class="text-core">HELPDESK </span></h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Session::get('email') }}" required autocomplete="email"  placeholder="Ketikkan email Anda" autofocus>

                                {{-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ketikkan password Anda">

                                    
                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                        </div>
                        

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group mt-4">
                                <button type="submit" class="btn btn-core btn-block">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('welcome'))
                                    <a class="btn btn-link btn-block" href="{{ route('welcome') }}">
                                        {{ __('Back') }}
                                    </a>
                                @endif

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
</div>
</section>

@endsection
