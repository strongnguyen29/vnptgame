<?php

namespace App\Models;

use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * @method static Builder active()
 */
class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    const TYPE_POST = 'post';
    const TYPE_RECRUIT = 'recruitment';

    const MEDIA_COLLECT = 'category_thumb';

    protected $fillable = [
        'parent_id',
        'type',
        'title',
        'slug',
        'desc',
        'sort',
        'active',
        'meta_title',
        'meta_desc',
        'language'
    ];

    protected $casts = ['sort' => 'integer', 'active' => 'boolean'];

    public $timestamps = false;

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts() {
        return $this->belongsToMany(Post::class, 'category_post');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
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
     * @param string $type
     * @return Builder
     */
    public function scopeType($query, $type) {
        return $query->where('type', $type);
    }

    /**
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeParentRoot($query) {
        return $query->where('parent_id', 0)->orWhereNull('parent_id');
    }

    /**
     * @param Builder $query
     * @param string $sort
     * @return Builder
     */
    public function scopeSort($query, $sort = 'asc') {
        return $query->orderBy('sort', $sort);
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
        if (!$file) return;

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
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getImageHtml($attrs = []) {
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('sort', function (Builder $builder) {
            $builder->sort('DESC');
        });
    }

    /**
     * Find category by slug
     * @param $slug string
     * @param $cols array
     * @return Category
     */
    public static function findBySlug($slug, $cols = ['*']) {
        return self::where('slug', $slug)->first($cols);
    }

    /**
     * @param $lang
     * @return mixed
     */
    public static function getTreeByLanguage($lang) {
        return Category::with([
                'children' => function ($query) use ($lang) {
                    $query->language($lang);
                },
                'children.children' => function ($query) use ($lang) {
                    $query->language($lang);
                }
            ])
            ->language($lang)
            ->where('parent_id', 0)
            ->orWhereNull('parent_id')
            ->type(Category::TYPE_POST)
            ->get();
    }
}
