<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles'])->get();
        return view('admin.users.index', compact('users'));

    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load(['roles', 'invoices' => function ($query) {
            $query->with(['recepit', 'currency', 'expense', 'income']);
        }]);
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeAjax(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'mobile' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return \response()->json([
                'status' => 400,
                'message' => $validator->errors(),
            ], 200);
        }
        $user = User::create($request->all());
        return \response()->json([
            'status' => 200,
            'message' => 'success',
        ], 200);

    }

    public function dataAjax(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $users = DB::table('users')->where('id', '!=', 1)->where('deleted_at', null)->orderby('name', 'asc')->limit(10)->get();
        } else {
            $users = DB::table('users')->where('id', '!=', 1)->where('deleted_at', null)->orderby('name', 'asc')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }
        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                "id" => $user->id,
                "text" => $user->name
            );
        }
        return response()->json($response);
    }

    public function dataEmployeesAjax(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $users = User::whereHas('roles', function ($query) {
                $query->where('id', 3);
            })->where('deleted_at', null)->orderby('name', 'asc')->take(10)->get();
        } else {
            $users = User::whereHas('roles', function ($query) {
                $query->where('id', 3);
            })->where('deleted_at', null)->orderby('name', 'asc')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }
        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                "id" => $user->name,
                "text" => $user->name
            );
        }
        return response()->json($response);
    }
}
