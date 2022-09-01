<?php

namespace App\Models;

use App\Traits\Vehicles\HasVehicles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, HasVehicles;
    protected $guard = 'admin';
    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password');
    protected $hidden = array('password');

    public function setPasswordAttribute($val){
        if (!empty($val)){
            $this->attributes['password'] = bcrypt($val);
        }
    }

}
