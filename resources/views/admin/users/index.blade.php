@extends('layout.admin')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('global-message.users') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">{{ __('global-message.users') }}</li>
            <li class="breadcrumb-item active">{{ __('global-message.table') }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-table me-1"></i>
                        {{ __('global-message.table_of_users') }}
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('users.create') }}" class="btn btn-success mb-3">
                                    {{ __('global-message.add_new_user') }}
                                </a>
                            </div>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%">
                            <thead>
                            <tr>
                                <th>{{ __('global-message.name') }}</th>
                                <th>{{ __('global-message.email_address') }}</th>
                                <th>{{ __('global-message.role') }}</th>
                                <th>{{ __('global-message.department') }}</th>
                                <th>{{ __('global-message.created_at') }}</th>
                                <th>{{ __('global-message.updated_at') }}</th>
                                <th>{{ __('global-message.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var userTable;
        window.addEventListener('DOMContentLoaded', () => {
            userTable = new DataTable('#dataTable', {
                'processing': true,
                'serverSide': true,
                'language': {"url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"},
                'ajax': "{{ route('users.datatable') }}",
                'searchDelay': 700,
                'columns': [
                    {name: 'name', data: 'name'},
                    {name: 'email', data: 'email'},
                    {name: 'role', data: 'role'},
                    {name: 'department', data: 'department'},
                    {name: 'created_at', data: 'created_at'},
                    {name: 'updated_at', data: 'updated_at'},
                    {
                        name: 'actions',
                        render: function (data, type, row) {
                            let grid = document.createElement('div');
                            grid.className = 'd-grid gap-2';

                            let edit_button = document.createElement('a');
                            edit_button.href = row.edit_url;
                            edit_button.className = 'btn btn-outline-primary btn-sm';
                            edit_button.innerHTML = 'Editar';

                            let delete_button = document.createElement('button');
                            delete_button.type = 'button';
                            delete_button.className = 'btn btn-outline-danger btn-sm';
                            delete_button.innerHTML = 'Eliminar';
                            delete_button.setAttribute('onclick', `deleteUser('${row.delete_url}')`);

                            grid.appendChild(edit_button);
                            grid.appendChild(delete_button);

                            return grid.outerHTML;
                        }
                    },
                ],
                'columnDefs': [{
                    'targets': [6],
                    'orderable': false,
                }]
            });
        });

        function deleteUser(url) {
            confirmationMessage(
                '¿Realmente quieres borrar este registro?',
                'Cancelar',
                'Eliminar'
            ).then((yes) => {
                if (yes) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    // set response type to json
                    xhr.responseType = 'json';
                    xhr.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            successMessage(this.response.message).then(() => {
                                userTable.draw();
                            });
                        }
                    }
                    xhr.send();
                }
            });
        }
    </script>
@endpush
