<?php

namespace Modules\Browse\Services;

use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\City;
use Modules\Address\Entities\Barangay;
use Modules\Businesses\Entities\Business;

class BrowseService
{

    public static function searchBusinessName($business_name = '')
    {

        $query = DB::table('businesses');

        $query->whereNull('deleted_at');

        $query->where('name', 'like', '%' . $business_name . '%');

        $query->limit(5);

        $query->select(['name']);

        $query->orderBy('name', 'asc');

        return $query->get();
    }

    public static function searchProductName($product_name = '')
    {

        $query = DB::table('products');

        $query->whereNull('deleted_at');

        $query->where('name', 'like', '%' . $product_name . '%');

        $query->limit(5);

        $query->select(['name']);

        $query->orderBy('name', 'asc');

        return $query->get();
    }

    public static function searchAddress($address = '')
    {
        $cityQuery = DB::table('address_city_municipalities');

        $cityQuery->where('address_city_municipalities.provCode', 619);

        $cityQuery->where('address_city_municipalities.citymunDesc', 'like', $address . '%');

        $cityQuery->selectRaw('CONCAT(citymunDesc, ", CAPIZ") as address');

        $brgyQuery = DB::table('address_barangays');

        $brgyQuery->where('address_barangays.provCode', 619);

        $brgyQuery->where('address_barangays.brgyDesc', 'like', $address . '%');

        $brgyQuery->join('address_city_municipalities', 'address_barangays.citymunCode', '=', 'address_city_municipalities.citymunCode');

        $brgyQuery->selectRaw('CONCAT(address_barangays.brgyDesc, ", ", address_city_municipalities.citymunDesc, ", CAPIZ") as address');

        $brgyQuery->union($cityQuery);

        $brgyQuery->limit(5);

        $brgyQuery->orderBy('address', 'asc');

        $result = $brgyQuery->get();

        return $result;
    }

    public static function searchSubcategories($category_id = '')
    {

        $query = DB::table('subcategories');

        $query->whereNull('deleted_at');

        $query->where('category_id', $category_id);

        // $query->limit(5);

        $query->select(['id', 'name']);

        $query->orderBy('name', 'asc');

        return $query->get();
    }
}
