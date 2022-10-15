<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Businesses\Entities\Business;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Subcategory\Entities\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Categories\Database\factories\CategoryFactory::new();
    }

    // public function businesses()
    // {
    //     return $this->belongsToMany(Business::class, 'business_categories');
    // }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
