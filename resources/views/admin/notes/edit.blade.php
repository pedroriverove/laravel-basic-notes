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
            <li class="breadcrumb-item active">{{ __('global-message.edit') }}</li>
            <li class="breadcrumb-item active">{{ $note->code }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-book me-1"></i>
                        Editar nota
                    </div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ route('notes.update', $note->id) }}">
                            @csrf
                            @method('PUT')
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
                                <label for="inputObservations"
                                       class="form-label">{{ __('global-message.observations') }}</label>
                                <textarea class="form-control @error('observations') is-invalid @enderror"
                                          id="inputObservations"
                                          name="observations"
                                          rows="4"
                                >{{ old('observations', $note->observations) }}</textarea>
                                @error('observations')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputState"
                                       class="form-label">{{ __('global-message.states') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="inputState"
                                        aria-label="Default select example"
                                        name="status"
                                >
                                    <option value="1" {{ $note->status == 1 ? 'selected' : '' }}>
                                        {{ __('global-message.pending') }}
                                    </option>
                                    <option value="2" {{ $note->status == 2 ? 'selected' : '' }}>
                                        {{ __('global-message.in_progress') }}
                                    </option>
                                    <option value="3" {{ $note->status == 3 ? 'selected' : '' }}>
                                        {{ __('global-message.finished') }}
                                    </option>
                                </select>
                                @error('status')
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
                        {{ __('global-message.note_information') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('global-message.code') }}</th>
                                <td>{{ $note->code }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.department') }}</th>
                                <td>{{ __('global-message.' . $note->department->slug) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.created_by') }}</th>
                                <td>{{ __('global-message.' . $note->user->name) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.client_name') }}</th>
                                <td>{{ $note->client->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.client_company') }}</th>
                                <td>{{ $note->client->company }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.description') }}</th>
                                <td>{{ $note->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.created_at') }}</th>
                                <td>{{ Helper::customDateFormat($note->created_at) }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('global-message.updated_at') }}</th>
                                <td>{{ Helper::customDateFormat($note->updated_at) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
