<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'location',
        'summary',
        'description',
        'cover_image',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class, 'event_id')->orderBy('order', 'asc');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->event_date ? $this->event_date->format('M d, Y') : 'Upcoming';
    }

    public function getPhotosCountAttribute(): int
    {
        return $this->images()->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $baseSlug = Str::slug($event->title);
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                $event->slug = $slug;
            }
        });
    }
}
