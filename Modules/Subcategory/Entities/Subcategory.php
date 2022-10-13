<?php

namespace Modules\Subcategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Categories\Entities\Category;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
    ];

    // protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Subcategory\Database\factories\SubcategoryFactory::new();
    // }

    // public function businesses()
    // {
    //     return $this->hasMany(Business::class);
    // }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_categories');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
