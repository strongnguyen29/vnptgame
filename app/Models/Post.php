<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use App\Models\Traits\HasThumb;
use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Tags\HasTags;

/**
 * @property string title
 * @property string slug
 * @property string desc
 * @property string content
 * @property string active
 * @property string meta_title
 * @property string meta_desc
 * @property string id
 * @property string url
 * @property string thumb
 * @property Collection categories
 * @method static Builder active()
 */
class Post extends Model implements HasMedia
{
    use HasFactory, HasTags, HasThumb, HasTranslations, HasSlug;

    const MEDIA_COLLECT = 'post_thumb';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'desc',
        'content',
        'active',
        'meta_title',
        'meta_desc',
        'language'
    ];

    protected $casts = ['active' => 'boolean'];

    protected $with = ['media'];

    protected $appends = ['url', 'thumb'];

    /**
     * @return string
     */
    public function getUrlAttribute() {
        return $this->slug ? route('front.posts.detail', ['slug' => $this->slug]) : '';
    }

    /**
     * tac gia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @param Builder $query
     * @param bool $active
     * @return Builder
     */
    public function scopeActive($query, $active = true) {
        return $query->where('active', $active);
    }
}
