<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_name',
        'slug',
        'title',
        'subtitle',
        'description',
        'author',
        'create_date',
        'published_at',
        'status',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'tags',
        'view_count',
        'read_time',
        'language',
        'visibility',
        'thumbnail',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'read_time' => 'integer',
        'create_date' => 'date',
        'published_at' => 'datetime',
    ];

    // These will be appended to model JSON and array output
    protected $appends = ['featured_image_url', 'thumbnail_url'];

    /**
     * Get the full URL of the featured image
     *
     * @return string
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : asset('storage/Blogs_images/default.jpg');
    }

    /**
     * Get the full URL of the thumbnail image
     *
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail
            ? asset('storage/' . $this->thumbnail)
            : asset('storage/Blogs_images/default_thumbnail.jpg');
    }
}
