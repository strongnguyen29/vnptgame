<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use App\Models\Traits\HasThumb;
use App\Models\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Recruitment extends Model implements HasMedia
{
    use HasFactory, HasThumb, HasTranslations, HasSlug;

    const MEDIA_COLLECT = 'recruitment_thumb';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'desc',
        'content',
        'active',
        'meta_title',
        'meta_desc',
        'language',
        'deadline'
    ];

    protected $casts = ['active' => 'boolean', 'deadline' => 'date'];

    protected $with = ['media'];

    protected $appends = ['url', 'thumb'];

    /**
     * @return string
     */
    public function getUrlAttribute() {
        return $this->slug ? route('front.recruitments.detail', ['slug' => $this->slug]) : '';
    }

    /**
     * tac gia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applies() {
        return $this->hasMany(RecruitmentApply::class);
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
