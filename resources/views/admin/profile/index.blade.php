@extends('layout.admin')

@section('title', 'Perfil')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('global-message.profile') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ __('global-message.profile') }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-user me-1"></i>
                        {{ __('global-message.edit_profile') }}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">{{ __('global-message.name') }}</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="inputName"
                                       placeholder="{{ __('global-message.name') }}"
                                       name="name" value="{{ $user->name }}"
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
                                       placeholder="{{ __('global-message.email_address') }}"
                                       name="email" value="{{ $user->email }}"
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
                                       placeholder="{{ __('global-message.password') }}"
                                       name="password"
                                >
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                                    @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('global-message.update') }}</button>
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
                                <th>{{ __('global-message.created_at') }}</th>
                                <td>{{ Helper::customDateFormat($user->created_at) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.updated_at') }}</th>
                                <td>{{ Helper::customDateFormat($user->updated_at) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
