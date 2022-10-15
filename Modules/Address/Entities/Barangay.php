<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Address\Database\factories\BarangayFactory::new();
    // }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_barangays';

    public function businesses()
    {
        return $this->hasMany(Business::class, 'barangay_id', 'regCode');
    }
}
