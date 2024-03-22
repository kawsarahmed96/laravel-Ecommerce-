@extends('layouts.frontendapp')
@section('title', 'Login/Registration')
@section('content')
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index-2.html">Home</a></li>
                <li>Login/Register</li>
            </ul>
        </div>
    </div>
    <section class="register_section section_space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <ul class="nav register_tabnav ul_li_center" role="tablist">
                        <li role="presentation">
                            <button data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab"
                                aria-controls="signin_tab" aria-selected="true">Sign In</button>
                        </li>
                        <li role="presentation">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button"
                                role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                        </li>
                    </ul>

                    <div class="register_wrap tab-content">
                        <div class="tab-pane fade" id="signin_tab" role="tabpanel">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form_item_wrap">
                                    <h3 class="input_title">User Email*</h3>
                                    <div class="form_item">
                                        <label for="username_input"><i class="fas fa-user"></i></label>

                                        <input class="@error('email') is-invalid @enderror" id="email" name="email"
                                            type="email" placeholder="User Email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Password*</h3>
                                    <div class="form_item">
                                        <label for="password_input"><i class="fas fa-lock"></i></label>

                                        <input class="@error('password') is-invalid @enderror" id="password"
                                            name="password" name="password" type="password" placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="checkbox_item">

                                        <input id="remember_checkbox" id="remember" name="remember" type="checkbox"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember_checkbox">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <button class="btn btn_primary" type="submit">Sign In</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade show active" id="signup_tab" role="tabpanel">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form_item_wrap">
                                    <h3 class="input_title">User Name*</h3>
                                    <div class="form_item">
                                        <label for="username_input2"><i class="fas fa-user"></i></label>
                                        <input id="username_input2" name="name" type="text" placeholder="User Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Email*</h3>
                                    <div class="form_item">
                                        <label for="email_input"><i class="fas fa-envelope"></i></label>
                                        <input id="email_input" name="email" type="email" placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Password*</h3>
                                    <div class="form_item">
                                        <label for="password_input2"><i class="fas fa-lock"></i></label>
                                        <input id="password_input2" name="password" type="password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form_item_wrap">
                                    <h3 class="input_title">Confirm Password*</h3>
                                    <div class="form_item">
                                        <label for="password_input3"><i class="fas fa-lock"></i></label>
                                        <input id="password_input3" name="password_confirmation" type="password"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <button class="btn btn_secondary" type="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
