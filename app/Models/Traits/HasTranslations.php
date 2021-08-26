<?php


namespace App\Models\Traits;

trait HasTranslations
{

    /**
     * language name
     *
     * @return string
     */
    public function getLanguageNameAttribute() {
        switch ($this->language) {
            case 'vi': return 'Tiếng việt';
            case 'en': return 'English';
            default: return $this->language;
        }
    }

    /**
     * @param $query
     * @param null $lang
     * @return mixed
     */
    public function scopeLanguage($query, $lang = null) {
        return $query->where('language', $lang ?? app()->getLocale());
    }
}
