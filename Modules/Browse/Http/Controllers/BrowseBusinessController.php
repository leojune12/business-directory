<?php

namespace Modules\Browse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Businesses\Entities\Business;
use Modules\Categories\Entities\Category;

class BrowseBusinessController extends Controller
{
    public $module = 'Business';

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->ajaxHandler($request);
        }

        $categories = Category::orderBy('name')->get();

        return view('browse::business.index', [
            'module' => $this->module,
            'categories' => $categories,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = DB::table('businesses');

        $query->whereNull('businesses.deleted_at');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->join('categories', 'categories.id', '=', 'businesses.category_id');

        $query->select(
            'businesses.id',
            'businesses.name',
            'businesses.full_address',
            'businesses.rating',
            'businesses.description',
            'categories.name as category_name',
        );

        $this->queryHandler($query, $request);

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->business_name != 'null', function ($query) use ($request) {
            return $query->where('businesses.name', 'like', $request->business_name . '%');
        });

        $query->when($request->location != 'null', function ($query) use ($request) {
            return $query->where('businesses.full_address', 'like', '%' .$request->location . '%');
        });

        $query->when($request->category_id != 'null', function ($query) use ($request) {
            return $query->where('categories.id', $request->category_id);
        });

        return $query;
    }

    public function businessShow($id, $slug = '')
    {
        $model = Business::findOrFail($id)->load('category', 'subcategories', 'region', 'province', 'city', 'barangay');

        if ($model->slug != $slug) {

            abort(404);
        }

        return view('businesses::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }
}
