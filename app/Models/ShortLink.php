<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $short_link
 * @property Collection $users
*/
class ShortLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'link',
        'short_link',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_links', 'short_links_id', 'users_id');
    }

    /**
     * Resolve the model for route model binding.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value)) {
            return $this->where('id', $value)->firstOrFail();
        }

        return $this->where('short_link', $value)->firstOrFail();
    }
}
