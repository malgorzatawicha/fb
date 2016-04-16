<?php namespace Fb\Services\StoragePaths;

class CategoryPath
{
    private $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function initializePaths()
    {
        $config = \config('fb.category');
        $paths = [
            $config['path'] . '/'. $this->categoryId . '/',
        ];

        foreach ($paths as $path) {
            @mkdir($path, 0777, true);
            chmod($path, 0777);
        }
    }

}
