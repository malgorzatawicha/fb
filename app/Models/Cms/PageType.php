<?php namespace Fb\Models\Cms;

class PageType
{
    private static $types = [
        ['name' => 'main', 'single' => true],
        ['name' => 'friends', 'single' => true],
        ['name' => 'contact', 'single' => true],
        ['name' => 'gallery', 'single' => false],
        ['name' => 'custom', 'single' => false]
    ];

    public static function getPossibleTypes(Page $page = null)
    {
        $result = [];
        foreach (static::$types as $type) {
            if (static::isAllowable($type, $page)) {
                $result[] = $type['name'];
            }
        }
        return $result;
    }

    private static function isAllowable(array $type, Page $page = null)
    {
        return (
            static::pageHasType($type, $page) ||
            static::isMulti($type) ||
            static::hasNoPageOf($type)
        );
    }

    private static function pageHasType(array $type, Page $page = null)
    {
        return (!empty($page) && $page->type == $type['name']);
    }

    private static function isMulti(array $type)
    {
        return empty($type['single']);
    }

    private static function hasNoPageOf(array $type)
    {
        return !static::hasPage($type['name']);
    }

    private static function hasPage($type)
    {
        return (Page::whereType($type)->whereActive(true)->count() > 0);
    }
}