@extends('layout.admin')

@section('title', 'Nota')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('global-message.note') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('notes.index') }}">
                    {{ __('global-message.note') }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ __('global-message.create') }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-book me-1"></i>
                        Añadir nueva nota
                    </div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ route('notes.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="inputDepartment"
                                       class="form-label">{{ __('global-message.departments') }}</label>
                                <select class="form-select @error('department_id') is-invalid @enderror"
                                        id="inputDepartment"
                                        aria-label="Default select example"
                                        name="department_id"
                                >
                                    @foreach ($departments as $department)
                                        <option
                                            value="{{ $department->id }}" {{ $department->id == $note->department_id ? 'selected' : '' }}>
                                            {{ __('global-message.' . $department->slug) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription"
                                       class="form-label">{{ __('global-message.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="inputDescription"
                                          name="description"
                                          rows="6"
                                >{{ old('description', $note->description) }}</textarea>
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputClientName"
                                       class="form-label">{{ __('global-message.client_name') }}</label>
                                <input type="text"
                                       class="form-control @error('client_name') is-invalid @enderror"
                                       id="inputClientName"
                                       placeholder="e.g. John Doe"
                                       name="client_name"
                                >
                                @error('client_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputClientCompany"
                                       class="form-label">{{ __('global-message.client_company') }}</label>
                                <input type="text"
                                       class="form-control @error('client_company') is-invalid @enderror"
                                       id="inputClientCompany"
                                       placeholder="YouTube"
                                       name="client_company"
                                >
                                @error('client_company')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputClientPhoneNumber"
                                       class="form-label">{{ __('global-message.client_phone') }}</label>
                                <input type="text"
                                       class="form-control @error('client_phone_number') is-invalid @enderror"
                                       id="inputClientPhoneNumber"
                                       placeholder="YouTube"
                                       name="client_phone_number"
                                >
                                @error('client_phone_number')
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
