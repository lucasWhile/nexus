<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    protected $table = 'post_user';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
