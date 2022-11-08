<?php

namespace Modules\Browse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Businesses\Entities\Business;

class BrowseController extends Controller
{
    public $module = 'Browse';

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->ajaxHandler($request);
        }

        return view('browse::index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = Business::whereNull('deleted_at');

        // Eager Loading
        $query->with('user:id,first_name,last_name', 'category', 'province', 'city', 'barangay');

        $this->queryHandler($query, $request);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->business_name != 'null', function ($query) use ($request) {
            return $query->where('name', 'like', $request->business_name . '%');
        });

        $query->when($request->location != 'null', function ($query) use ($request) {
            return $query->where('full_address', 'like', '%' .$request->location . '%');
        });

        return $query;
    }
}
