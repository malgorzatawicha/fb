<?php namespace Fb\Services;

class StorageProjectPath
{
    private $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function initializePaths()
    {
        $config = \config('fb.project');
        $paths = [
            $config['path'] . '/'. $this->projectId . '/' . $config['logo']['subPath'],
        ];
        foreach ($config['image']['subPaths'] as $subPath) {
            $paths[] = $config['path'] . '/'. $this->projectId . '/' . $subPath;
        }

        foreach ($paths as $path) {
            @mkdir($path, 0777, true);
            chmod($path, 0777);
        }
    }

}
