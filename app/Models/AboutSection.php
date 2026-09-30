<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $table = 'about_sections';

    protected $fillable = [
        'title',
        'tagline',
        'description_1',
        'description_2',
        'founder_name',
        'founder_role',
        'founder_photo',
        'image_1',
        'image_2',
        'image_3',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'cta_image',
    ];
}
