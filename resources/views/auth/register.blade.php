@extends('layouts.auth')
@section('title')
    <title>HELPDESK - REGISTER</title>
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
                        <a href="{{ route('login') }}"> Login</a>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of Navbar -->
@endsection
@section('content')
<section class="my-register">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Register <span class="text-core">HELPDESK </span></h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        @if ($message = Session::get('usernotfound'))
                            <div class="alert alert-danger alert-block">
                                {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Ketikkan nama lengkap Anda" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Ketikkan email Anda" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ketikkan password Anda" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>

                           
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Ketikkan kembali password Anda" autocomplete="new-password">
                            
                        </div>

                        <div class="form-group mt-4">
                                <button type="submit" class="btn btn-core btn-block">
                                    {{ __('Register') }}
                                </button>

                                @if (Route::has('welcome'))
                                    <a class="btn btn-link btn-block" href="{{ route('welcome') }}">
                                        {{ __('Back') }}
                                    </a>
                                @endif
                            
                        </div>
                    </form>
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
