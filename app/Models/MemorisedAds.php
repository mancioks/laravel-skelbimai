<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemorisedAds extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function ad()
    {
        return $this->hasOne(Ad::class, 'id', 'ad_id');
    }
}
