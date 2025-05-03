<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProfile
 */
class Profile extends Model
{

    protected $table = 'profiles';
    protected $fillable = [
        'lattes_url',
        'user_id',
     
    ];
public function user()
    {
        return $this->belongsTo(User::class);
    }

}
