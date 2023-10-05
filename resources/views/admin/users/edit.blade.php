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
            <li class="breadcrumb-item active">{{ __('global-message.edit') }}</li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-user me-1"></i>
                        Editar usuario
                    </div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="inputName" class="form-label">{{ __('global-message.name') }}</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="inputName"
                                       placeholder="e.g. John Doe"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
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
                                       value="{{ old('email', $user->email) }}"
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
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-info-circle me-1"></i>
                        {{ __('global-message.user_information') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('global-message.name') }}</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.email_address') }}</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.role') }}</th>
                                <td>{{ $user->role->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.department') }}</th>
                                <td>{{ $user->department->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.last_active') }}</th>
                                <td>{{ ($user->last_activity) ? Helper::customDateFormat($user->last_activity, 'd F Y H:i:s') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
