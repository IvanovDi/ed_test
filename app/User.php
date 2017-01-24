<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'head_user_id'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function headUser()
    {
        return $this->hasOne(User::class, 'id', 'head_user_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'head_user_id');
    }

    public function subordinateGroups()
    {
        return $this->hasMany(Group::class, 'head_user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

}
