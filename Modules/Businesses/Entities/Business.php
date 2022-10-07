<?php

namespace Modules\Businesses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Users\Entities\User;

class Business extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'user_name'
    ];

    protected $fillable = [];

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
}
