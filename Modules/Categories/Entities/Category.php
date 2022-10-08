<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Businesses\Entities\Business;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Categories\Database\factories\CategoryFactory::new();
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_categories');
    }
}
