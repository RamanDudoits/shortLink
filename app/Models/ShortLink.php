<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'link',
        'short_link',
    ];

    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_links', 'short_links_id', 'users_id');
    }
}
