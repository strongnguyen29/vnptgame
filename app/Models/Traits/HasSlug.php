<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * set slug field
     *
     * @param $value
     */
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = Str::slug($value ?? $this->title);
    }

    /**
     * get slug field
     *
     * @param $value
     * @return string
     */
    public function getSlugAttribute($value) {
        return Str::slug($value ?? $this->title);
    }

    /**
     * @param Builder $query
     * @param $slug string
     * @return Builder
     */
    public function scopeSlug($query, $slug) {
        return $query->where('slug', $slug);
    }
}
