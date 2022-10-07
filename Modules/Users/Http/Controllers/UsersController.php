<?php

namespace Modules\Users\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Modules\Users\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public $module = 'User';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        $roles = Role::all()->pluck('name');

        return view('users::index', [
            'module' => $this->module,
            'roles' => $roles,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = User::whereNull('deleted_at');

        $query->with('roles');

        $this->queryHandler($query, $request);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->first_name != 'null', function ($query) use ($request) {
            return $query->where('first_name', 'like', '%' . $request->first_name . '%');
        });

        $query->when($request->last_name != 'null', function ($query) use ($request) {
            return $query->where('last_name', 'like', '%' . $request->last_name . '%');
        });

        $query->when($request->email != 'null', function ($query) use ($request) {
            return $query->where('email', 'like', '%' . $request->email . '%');
        });

        $query->when($request->role != 'null', function ($query) use ($request) {
            return $query->role($request->role);
        });

        return $query;
    }

    public function create()
    {
        $roles = Role::all()->pluck('name');

        return view('users::form', [
            'module' => $this->module,
            'method' => 'Create',
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ],
            'role' => [
                'required',
                'exists:roles,name'
            ],
            'password' => [
                'required',
                Rules\Password::defaults()
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Whoops!',
                'message' => 'Please complete the form.',
                'errors' => $validator->errors(),
                'old' => $request->all(),
            ]);
        }

        DB::beginTransaction();

        try {

            $request['password'] = Hash::make($request->password);

            $model = User::create($request->except(['role']));

            $model->assignRole($request->role);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Item successfully created.'
            ]);
        } catch (Throwable $e) {

            // return $e;
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'title' => 'Something went wrong!',
                'message' => 'Please try again.'
            ]);
        }
    }

    public function show($id)
    {
        $model = User::findOrFail($id);

        return view('users::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model
        ]);
    }

    public function edit($id)
    {
        $roles = Role::all()->pluck('name');
        $model = User::findOrFail($id);

        return view('users::form', [
            'module' => $this->module,
            'method' => 'Update',
            'model' => $model,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($model->id),
            ],
            'role' => [
                'required',
                'exists:roles,name'
            ],
            // 'password' => [
            //     'sometimes',
            //     Rules\Password::default()
            // ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Whoops!',
                'message' => 'Please complete the form.',
                'errors' => $validator->errors(),
                'old' => $request->all(),
            ]);
        }

        DB::beginTransaction();

        try {

            $model->update($request->except(['role']));

            $model->syncRoles([$request->role]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Item successfully created.'
            ]);
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'title' => 'Something went wrong!',
                'message' => 'Please try again.'
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            User::destroy($request->id_array);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Item deleted successfully.'
            ]);
        } catch (Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Whoops! Something went wrong. Please try again.'
            ]);
        }
    }
}
