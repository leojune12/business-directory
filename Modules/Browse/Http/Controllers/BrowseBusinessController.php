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
            'businesses.slug',
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

    public function viewBusiness($id, $slug = '')
    {
        $business = DB::table('businesses');
        $business->whereNull('businesses.deleted_at');
        $business->where('businesses.id', $id);
        $business->join('categories', 'categories.id', '=', 'businesses.category_id');
        $business->select(
            'businesses.id',
            'businesses.name',
            'businesses.slug',
            'businesses.category_id',
            'businesses.full_address',
            'businesses.rating',
            'businesses.description',
            'businesses.contact_number',
            'businesses.email',
            'businesses.website',
            'businesses.facebook_link',
            'businesses.map_location',
            'categories.name as category_name',
        );

        $model = $business->first();

        if ($slug != $model->slug) {

            abort(404);
        }

        $subcategories = DB::table('business_subcategories');
        $subcategories->whereNull('business_subcategories.deleted_at');
        $subcategories->where('business_subcategories.business_id', $id);

        $subcategories->join('subcategories', 'subcategories.id', '=', 'business_subcategories.subcategory_id');

        $subcategories->select(
            'subcategories.id',
            'subcategories.name',
        );

        $subcategories->orderBy('name', 'asc');

        return view('browse::business.view-business', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
            'subcategories' => $subcategories->get(),
        ]);
    }
}
