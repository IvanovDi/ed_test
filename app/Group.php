<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'head_user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function headGroupUser()
    {
        return $this->belongsTo(User::class, 'head_user_id');
    }
}
