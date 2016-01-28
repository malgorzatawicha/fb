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

    public static function getPossibleTypes()
    {
        $result = [];
        foreach (static::$types as $type) {
            if (!$type['single'] || !static::hasPage($type['name'])) {
                $result[] = $type['name'];
            }
        }
        return $result;
    }

    private static function hasPage($type)
    {
        return (Page::whereType($type)->whereActive(true)->count() > 0);
    }
}