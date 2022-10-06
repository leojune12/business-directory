<?php

namespace Modules\Users\Entities;

// use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Businesses\Entities\Business;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $appends = ['full_name', 'role', 'date_added'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\UserFactory::new();
    }

    /**
     * Get the businesses for the user.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function getFullNameAttribute()
    {
        $first_name = $this->first_name ? $this->first_name . ' ' : '';
        $last_name = $this->last_name ? $this->last_name : '';
        return $first_name . $last_name;
    }

    public function getRoleAttribute()
    {
        return $this->roles[0]->name ?? '';
    }

    public function getDateAddedAttribute()
    {
        return $this->created_at ? date_format($this->created_at, 'm-d-Y H:i:s') : '';
    }
}
