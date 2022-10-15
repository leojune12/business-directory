<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Businesses\Entities\Business;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [];

    // protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Address\Database\factories\RegionFactory::new();
    // }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_regions';

    public function provinces()
    {
        return $this->hasMany(Province::class, 'regCode', 'regCode');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'region_id', 'regCode');
    }
}
