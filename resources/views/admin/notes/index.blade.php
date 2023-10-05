@extends('layout.admin')

@section('title', 'Notas')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ __('global-message.notes') }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">{{ __('global-message.notes') }}</li>
            <li class="breadcrumb-item active">{{ __('global-message.table') }}</li>
        </ol>
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-table me-1"></i>
                        {{ __('global-message.table_of_notes') }}
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('notes.create') }}" class="btn btn-success mb-3">
                                    {{ __('global-message.add_new_note') }}
                                </a>
                            </div>
                        </div>
                        <table class="table table-sm table-bordered" id="dataTable" width="100%">
                            <thead>
                            <tr>
                                <th>{{ __('global-message.code') }}</th>
                                <th>{{ __('global-message.department') }}</th>
                                <th>{{ __('global-message.created_by') }}</th>
                                <th>{{ __('global-message.client_name') }}</th>
                                <th>{{ __('global-message.description') }}</th>
                                <th>{{ __('global-message.state') }}</th>
                                <th>{{ __('global-message.created_at') }}</th>
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
        let noteTable;
        window.addEventListener('DOMContentLoaded', () => {
            noteTable = new DataTable('#dataTable', {
                'responsive': true,
                'processing': true,
                'serverSide': true,
                'language': {"url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"},
                'ajax': "{{ route('notes.datatable') }}",
                'searchDelay': 700,
                'scrollX': true,
                'createdRow': function (row, data, dataIndex) {
                    if (data.state === 1) {
                        $(row).addClass('table-primary');
                    } else if (data.state === 2) {
                        $(row).addClass('table-warning');
                    } else if (data.state === 3) {
                        $(row).addClass('table-success');
                    }

                    if (data.deleted_at !== null) {
                        $(row).addClass('table-danger');
                    }
                },
                'columns': [
                    {name: 'code', data: 'code'},
                    {name: 'department', data: 'department'},
                    {name: 'user', data: 'user'},
                    {name: 'client_name', data: 'client_name'},
                    {name: 'description', data: 'description'},
                    {
                        name: 'status',
                        data: 'status',
                        render: function (data, type, row) {
                            return unescapeHtml(row.status);
                        }
                    },
                    {name: 'created_at', data: 'created_at'},
                    {
                        name: 'actions',
                        render: function (data, type, row) {
                            let grid = document.createElement('div');
                            grid.className = 'd-grid gap-2';

                            if (row.deleted_at === null) {
                                let edit_button = document.createElement('a');
                                edit_button.href = row.edit_url;
                                edit_button.className = 'btn btn-outline-primary btn-sm';
                                edit_button.innerHTML = 'Editar';

                                let delete_button = document.createElement('button');
                                delete_button.type = 'button';
                                delete_button.className = 'btn btn-outline-danger btn-sm';
                                delete_button.innerHTML = 'Eliminar';
                                delete_button.setAttribute('onclick', `deleteNote('${row.delete_url}')`);

                                grid.appendChild(edit_button);
                                grid.appendChild(delete_button);

                                return grid.outerHTML;
                            } else {
                                let reactivate_button = document.createElement('button');
                                reactivate_button.type = 'button';
                                reactivate_button.className = 'btn btn-outline-danger btn-sm';
                                reactivate_button.innerHTML = 'Activar';
                                reactivate_button.setAttribute('onclick', `reactivateNote('${row.reactivate_url}')`);

                                grid.appendChild(reactivate_button);

                                return grid.outerHTML;
                            }

                            return '';
                        }
                    },
                ],
                'columnDefs': [
                    {
                        'targets': [5, 7],
                        'orderable': false
                    },
                    {
                        'targets': [3],
                        'type': 'html'
                    }
                ]
            });
        });

        function deleteNote(url) {
            confirmationMessage(
                '¿Realmente quieres borrar este registro?',
                'Cancelar',
                'Eliminar'
            ).then((yes) => {
                if (yes) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('PUT', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.responseType = 'json';
                    xhr.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            successMessage(this.response.message).then(() => {
                                noteTable.draw();
                            });
                        } else {
                            errorMessage(this.response.message).then(() => {
                                noteTable.draw();
                            });
                        }
                    }
                    xhr.send();
                }
            });
        }

        function reactivateNote(url) {
            confirmationMessage(
                '¿Realmente quieres reactivar este registro?',
                'Cancelar',
                'Confirmar'
            ).then((yes) => {
                if (yes) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('PUT', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.responseType = 'json';
                    xhr.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            successMessage(this.response.message).then(() => {
                                noteTable.draw();
                            });
                        } else {
                            errorMessage(this.response.message).then(() => {
                                noteTable.draw();
                            });
                        }
                    }
                    xhr.send();
                }
            });
        }

        function unescapeHtml(str) {
            return str.replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
        }
    </script>
@endpush
