<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $title = "List Role";
        return view('admin.role.index', compact('title'));
    }

    public function getRoles(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.role.edit', $row->id);
                    // $show_url = route('admin.role.show', $row->id);
                    $actionBtn = '
                <a class="btn btn-info" href="' . $edit_url . '">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil">
                        </use>
                    </svg>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash">
                        </use>
                    </svg>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $title = "Bikin Role";
        $permission = Permission::get();
        return view('admin.role.create', compact('title', 'permission'));
    }

    public function show(Role $role)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permission);

        return redirect()->route('admin.role')->with('success', 'Role berhasil dibuat!');
    }

    public function edit(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.role')->with('success', 'Permission berhasil diubah!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['status' => TRUE]);
    }
}
