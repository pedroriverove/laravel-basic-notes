@extends('layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">{{ __('global-message.login') }}</h3>
                    </div>
                    <div class="card-body">
                        @include('partials.flash')
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       id="inputEmail"
                                       placeholder="{{ __('global-message.email_address') }}"
                                       value="{{ old('email') }}"
                                />
                                <label for="inputEmail">{{ __('global-message.email_address') }}</label>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       id="inputPassword"
                                       placeholder="{{ __('global-message.password') }}"
                                />
                                <label for="inputPassword">{{ __('global-message.password') }}</label>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button class="btn btn-primary w-100 btn-lg"
                                        type="submit"
                                >
                                    {{ __('global-message.login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">
                            <a href="{{ route('register') }}">{{ __('global-message.need_an_account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
