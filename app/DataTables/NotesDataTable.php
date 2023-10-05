<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Models\Note;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NotesDataTable
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function datatable(Request $request)
    {
        $select = (new NoteRepository())->selectDatatable();

        return datatables()->of($select)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $query->where('code', 'like', "%{$request->search['value']}%");
                    $query->orWhere('departments.name', 'like', "%{$request->search['value']}%");
                    $query->orWhere('users.name', 'like', "%{$request->search['value']}%");
                    $query->orWhere('clients.name', 'like', "%{$request->search['value']}%");
                    $query->orWhere('description', 'like', "%{$request->search['value']}%");
                }
            })
            ->editColumn('description', function ($note) {
                return Str::limit($note->description, 20, '...');
            })
            ->editColumn('status', function ($query) {
                $status = 'primary';
                switch ($query->status) {
                    case Note::STATUS_IN_PROGRESS:
                        $status = 'dark';
                        break;
                    case Note::STATUS_FINISHED:
                        $status = 'success';
                        break;
                }
                return '<span class="badge bg-' . $status . '">' . Helper::convertState($query->status) . '</span>';
            })
            ->editColumn('created_at', function ($note) {
                return Helper::customDateFormat($note->created_at);
            })
            ->editColumn('notes.deleted_at', function ($note) {
                return Helper::customDateFormat($note->deleted_at);
            })
            ->addColumn('edit_url', function ($note) {
                return route('notes.edit', $note->id);
            })
            ->addColumn('delete_url', function ($note) {
                return route('notes.destroy', $note->id);
            })
            ->addColumn('reactivate_url', function ($note) {
                return route('notes.reactivate', $note->id);
            })
            ->make(true);
    }
}
