<?php

namespace App\Models;

use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
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
    use HasFactory, HasTags, InteractsWithMedia, HasTranslations;

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
     * @param $value
     */
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value ?? $this->title);
    }

    /**
     * @return string
     */
    public function getUrlAttribute() {
        return $this->slug ? route('front.posts.detail', ['slug' => $this->slug]) : '';
    }

    /**
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getThumbAttribute() {
        return $this->getFirstMedia(self::MEDIA_COLLECT);
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

    /**
     * @param Builder $query
     * @param $slug
     * @return Builder
     */
    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }

    /**
     * Dang ky media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECT)
            ->withResponsiveImages()
            ->singleFile();
    }

    /**
     * Set image thumb
     *
     * @param $file
     */
    public function setImage($file) {

        try {
            $this->addMedia($file)
                ->setFileName(sprintf('%s.%s', $this->slug, $file->getClientOriginalExtension()))
                ->toMediaCollection(self::MEDIA_COLLECT);
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            Log::error('setImage post error: ' . $e->getMessage());
        }
    }

    /**
     *
     * @param array $attrs
     * @return \Spatie\MediaLibrary\MediaCollections\HtmlableMedia|\Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getImageHtml(array $attrs = []) {
        $media = $this->getFirstMedia(self::MEDIA_COLLECT);

        return $media ? $media->img('', $attrs) : null;
    }

    /**
     * @return string
     */
    public function getImageUrl() {
        $media = $this->getFirstMedia(self::MEDIA_COLLECT);

        return $media ? $media->getFullUrl() : '';
    }
}
