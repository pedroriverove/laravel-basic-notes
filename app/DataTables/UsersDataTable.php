<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function datatable(Request $request)
    {
        $select = (new UserRepository())->selectDatatable();

        return datatables()->of($select)
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value']) {
                    $query->where('users.name', 'like', "%{$request->search['value']}%");
                    $query->orWhere('email', 'like', "%{$request->search['value']}%");
                    $query->orWhere('roles.name', 'like', "%{$request->search['value']}%");
                    $query->orWhere('departments.name', 'like', "%{$request->search['value']}%");
                }
            })
            ->editColumn('created_at', function ($user) {
                return Helper::customDateFormat($user->created_at);
            })
            ->editColumn('updated_at', function ($user) {
                return Helper::customDateFormat($user->updated_at);
            })
            ->addColumn('edit_url', function ($user) {
                return route('users.edit', $user->id);
            })
            ->addColumn('delete_url', function ($user) {
                return route('users.destroy', $user->id);
            })
            ->make(true);
    }
}
