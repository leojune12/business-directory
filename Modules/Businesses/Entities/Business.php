<?php

namespace Modules\Businesses\Entities;

use Modules\Users\Entities\User;
use Modules\Address\Entities\City;
use Modules\Address\Entities\Region;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\Service;
use Modules\Address\Entities\Barangay;
use Modules\Address\Entities\Province;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Subcategory\Entities\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'user_name',
        'address',
    ];

    protected $fillable = [
        'name',
        'contact_number',
        'website',
        'facebook_link',
        'map_location',
        'description',
        'category_id',

        // Address
        'street',
        'region_id',
        'province_id',
        'city_id',
        'barangay_id',
    ];

    // protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Businesses\Database\factories\BusinessFactory::new();
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->last_name . ', ' . $this->user->first_name : '';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'business_subcategories');
    }

    // public function subcategory()
    // {
    //     return $this->belongsTo(Subcategory::class);
    // }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'regCode');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'provCode');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'citymunCode');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id', 'brgyCode');
    }

    public function getAddressAttribute()
    {
        $street = $this->street ? $this->street . ', ' : '';
        $barangay = $this->barangay ? $this->barangay->brgyDesc . ', ' : '';
        $city = $this->city ? $this->city->citymunDesc . ', ' : '';
        $province = $this->province ? $this->province->provDesc : '';

        return $street . $barangay . $city. $province;
    }
}
