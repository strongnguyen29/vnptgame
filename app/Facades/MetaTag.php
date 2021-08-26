<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static setTitle(array|string|null $__)
 * @method static setBreadcrumb(array $array)
 * @method static prependTitle($param)
 * @method static set(string $string, $param)
 * @method static array getBreadcrumb()
 * @method static setDescription(string $param)
 * @method static setDesc(string $strip_tags)
 */
class MetaTag extends Facade
{
    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'metatag';
    }

}
