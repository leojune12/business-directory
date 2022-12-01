<?php

namespace Modules\Browse\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Validator;

class BrowseProductController extends Controller
{
    public $module = 'Products';

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->ajaxHandler($request);
        }

        return view('browse::products.index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = DB::table('products');

        $query->whereNull('products.deleted_at');
        $query->where('products.is_available', 1);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->join('businesses', 'businesses.id', '=', 'products.business_id');

        $query->select(
            'products.id',
            'products.name',
            'products.slug',
            'products.price',
            'businesses.name as business_name',
            'businesses.full_address as business_full_address',
        );

        $this->queryHandler($query, $request);

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->product_name != 'null', function ($query) use ($request) {
            return $query->where('products.name', 'like', $request->product_name . '%');
        });

        $query->when($request->location != 'null', function ($query) use ($request) {
            return $query->where('businesses.full_address', 'like', '%' .$request->location . '%');
        });

        return $query;
    }

    public function viewProduct($id, $slug = '')
    {
        $product = DB::table('products');
        $product->whereNull('products.deleted_at');
        $product->where('products.is_available', 1);
        $product->where('products.id', $id);
        $product->join('businesses', 'businesses.id' , '=', 'products.business_id');
        $product->select(
            'products.id',
            'products.name',
            'products.slug',
            'products.description',
            'products.price',
            'products.price',
            'businesses.id as business_id',
            'businesses.name as business_name',
            'businesses.slug as business_slug'
        );

        $model = $product->first();

        if ($slug != $model->slug) {

            abort(404);
        }

        return view('browse::products.view-product', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }
}
