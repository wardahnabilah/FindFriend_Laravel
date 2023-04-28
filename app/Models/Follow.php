<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'follow_this_user'];

    public function followerUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followingUser() {
        return $this->belongsTo(User::class, 'follow_this_user');
    }
}
