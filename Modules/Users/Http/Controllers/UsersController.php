<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;

class UsersController extends Controller
{
    public $title = 'Users';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        return view('users::index', [
            'title' => $this->title,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = User::whereNull('deleted_at');

        $this->queryHandler($query, $request);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->name != 'null', function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->name . '%');
        });

        $query->when($request->code != 'null', function ($query) use ($request) {
            return $query->where('code', 'like', '%' . $request->code . '%');
        });

        $query->when($request->descriptive_title != 'null', function ($query) use ($request) {
            return $query->where('descriptive_title', 'like', '%' . $request->descriptive_title . '%');
        });

        return $query;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // public function index()
    // {

    //     return view('users::index', [
    //         'page_title' => "Users",
    //         'users' => User::with('roles')->paginate(10),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
