<?php namespace Fb\Services\StoragePaths;

class PagePath
{
    private $pageId;

    public function __construct($pageId)
    {
        $this->pageId = $pageId;
    }

    public function initializePaths()
    {
        $config = \config('fb.page');
        $paths = [
            $config['path'] . '/'. $this->pageId . '/' . $config['logo']['subPath'],
            $config['path'] . '/' . $this->pageId . '/' . $config['banner']['subPath']
        ];

        foreach ($paths as $path) {
            @mkdir($path, 0777, true);
            chmod($path, 0777);
        }
    }

}
