<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessCategory extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Categories\Database\factories\BusinessCategoryFactory::new();
    // }
}
