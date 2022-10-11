<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Address\Database\factories\ProvinceFactory::new();
    // }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_provinces';

    public function cities()
    {
        return $this->hasMany(City::class, 'provCode', 'provCode');
    }
}
