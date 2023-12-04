@extends('layouts.nav')

@section('content')
<section class="slider">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-capitalize">{{ __('Profile') }} <a>{{ Auth::user()->name }}
                </a>
                </div>

                <div class="card-body">
                    

                    <div class="row">
                        <div class="col-md-4">
                            @if($user->photo)
                                <img src="{{ asset('storage/photos/'.$user->photo) }}" class="img-thumbnail rounded mx-auto d-block">
                            @else
                                <img src="{{ asset('img/profile.png') }}" class="img-thumbnail rounded mx-auto d-block">
                            @endif
                            
                        </div>
                        <div class="col-md-8">
                            <form method="POST" action="{{ route('profileuser.update', $user->id) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name">

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                       
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="old_password" type="password" class="form-control" name="old_password" autocomplete="old-password">

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control " name="password" autocomplete="new-password">

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Change Profile Photo') }}</label>

                                    <div class="col-md-6">  
                                        <div class="custom-file">
                                        <input id="photo" type="file" class="custom-file-input" name="photo">
                                        <label class="custom-file-label" for="customFile">Pilih File</label>
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-core btn-block">
                                            {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer text-center">
    Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
</div>
</section>
@endsection