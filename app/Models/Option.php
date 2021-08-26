<?php


namespace App\Models;


use Illuminate\Support\Facades\Cache;

class Option extends \Appstract\Options\Option
{
    const HOME_PROJECTS = 'home_module_projects';
    const HOME_POSTS = 'home_module_posts';
    const CACHE_KEY = 'app_options';

    /**
     * Get the specified option value.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        // Lấy từ cache
        $options = Cache::remember(self::CACHE_KEY, 2592000, function () {
            return self::all()->pluck('value', 'key')->toArray();
        });

        if (isset($options[$key])) return $options[$key];

        if ($option = self::where('key', $key)->first()) {
            return $option->value;
        }

        return $default;
    }

    /**
     * Set a given option value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
        // @todo: return the option
    }

    /**
     * Remove/delete the specified option value.
     *
     * @param  string  $key
     * @return bool
     */
    public function remove($key)
    {
        $success = self::where('key', $key)->delete();

        if ($success) Cache::forget(self::CACHE_KEY);

        return (bool) $success;
    }
}
