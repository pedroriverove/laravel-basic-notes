@extends('layout.admin')

@section('title', 'Usuario')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('global-message.user') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">
                    {{ __('global-message.user') }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ __('global-message.create') }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-user me-1"></i>
                        Añadir nuevo usuario
                    </div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ route('users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">{{ __('global-message.name') }}</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="inputName"
                                       placeholder="e.g. John Doe"
                                       name="name"
                                >
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail"
                                       class="form-label">{{ __('global-message.email_address') }}</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="inputEmail"
                                       placeholder="e.g. name@example.com"
                                       name="email"
                                >
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword"
                                       class="form-label">{{ __('global-message.password') }}</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="inputPassword"
                                       name="password"
                                >
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputPasswordConfirmation"
                                       class="form-label">{{ __('global-message.confirm_password') }}</label>
                                <input type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="inputPasswordConfirmation"
                                       name="password_confirmation"
                                >
                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i>
                                {{ __('global-message.save') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
