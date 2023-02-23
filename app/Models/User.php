<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// Cashier Dependency:
use Laravel\Cashier\Billable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    /**
    * Devolver el customer asociado.  1:1 [USER] (1,1)-----<Es un>-----(0,1) [CUSTOMER]
    */
    public function customer() {
        return $this->hasOne(Customer::class, 'user_id');
    }
    /**
    * Los roles que tiene asignados un determinado usuario.
    */
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    // ROLES:
    public function isAdmin() {
        $roles = $this->roles;
        $is_admin = false;
        foreach($roles as $role) {
            if ($role->name === 'Administrador') $is_admin = true;
        }
        return $is_admin;
    }
    public function isUser() {
        $roles = $this->roles;
        $is_user = false;
        foreach($roles as $role) {
            if ($role->name === 'User') $is_user = true;
        }
        return $is_user;
    }
    public function isCustomer() {
        $roles = $this->roles;
        $is_customer = false;
        foreach($roles as $role) {
            if ($role->name === 'Customer') $is_customer = true;
        }
        return $is_customer;
    }
}
