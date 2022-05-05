<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ad_id', 'id');
    }

    public function usersMemorised()
    {
        return $this->hasMany(MemorisedAds::class, 'ad_id', 'id');
    }
}
