<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'id', 'slug', 'title', 'description', 'file',
        'badge', 'badge_class', 'icon', 'icon_class',
        'group_name', 'layout', 'is_published',
        'total_topics', 'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
        'total_topics' => 'integer',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('sort_order');
    }

    public function getDoneCountAttribute(): int
    {
        return $this->topics()->where('status', 'done')->count();
    }
}
