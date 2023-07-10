<?php

namespace App\Models;

use App\Services\Roles\RoleService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $attributes = [
        'password' => ''
    ];

    protected $appends = [
        // 'listOfRoles'
    ];

    public function hasRole($name)
    {
        $roleName = explode('.', $name);
        $roleName[1] = $roleName[1] ?? '';
        
        $role = $this->roles()
            ->whereIn('name', [$roleName[0], $name])
            ->first();

        return isset($role);
    }

    function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function getListOfRolesAttribute(): array
    {
        return RoleService::listOfRoles();
    }
}
