@extends('layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">{{ __('global-message.create_account') }}</h3>
                    </div>
                    <div class="card-body">
                        @include('partials.flash')
                        <form method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('name') is-invalid @enderror"
                                               id="inputName"
                                               type="text" name="name"
                                               placeholder="Enter your name"
                                               value="{{ old('name') }}"
                                        />
                                        <label for="inputName">{{ __('global-message.name') }}</label>
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control @error('email') is-invalid @enderror"
                                       id="inputEmail"
                                       type="email"
                                       name="email"
                                       placeholder="name@example.com"
                                       value="{{ old('email') }}"
                                />
                                <label for="inputEmail">{{ __('global-message.email_address') }}</label>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                               id="inputPassword"
                                               type="password"
                                               name="password"
                                               placeholder="Create a password"
                                               @error('password')
                                               value="{{ old('password') }}" @enderror
                                        />
                                        <label for="inputPassword">{{ __('global-message.password') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control @error('password') is-invalid @enderror"
                                               id="inputPasswordConfirm"
                                               type="password"
                                               name="password_confirmation"
                                               placeholder="Confirm password"
                                        />
                                        <label
                                            for="inputPasswordConfirm">{{ __('global-message.confirm_password') }}</label>
                                    </div>
                                </div>
                                @error('password')
                                <div class="col-md-12">
                                    <small class="text-danger">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-block btn-lg"
                                            type="submit">{{ __('global-message.create_account') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">
                            <a href="{{ route('login') }}">{{ __('global-message.have_an_account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
