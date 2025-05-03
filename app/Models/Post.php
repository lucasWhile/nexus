<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'title',
        'abstract',
        'status',
        'image',
        'start_date',
        'end_date',
        'project_url',
        'call_number',
        'research_group',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
