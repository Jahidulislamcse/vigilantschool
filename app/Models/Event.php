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
        return $this->event_date ? $this->event_date->format('M d, Y') : '';
    }

    public function getPhotosCountAttribute(): int
    {
        return $this->images()->count();
    }

    public function getCoverPhotoAttribute(): string
    {
        $firstImage = $this->images->first();
        if ($firstImage && !empty($firstImage->image)) {
            return asset($firstImage->image);
        }
        if (!empty($this->cover_image)) {
            return asset($this->cover_image);
        }
        return asset('kider/img/carousel-1.jpg');
    }

    public function getDisplayTitleAttribute(): string
    {
        if (!empty($this->title)) {
            return $this->title;
        }
        return 'School Event Album #' . $this->id;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $baseSlug = !empty($event->title) ? Str::slug($event->title) : 'album-' . time();
                if (empty($baseSlug)) {
                    $baseSlug = 'album-' . time();
                }
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
