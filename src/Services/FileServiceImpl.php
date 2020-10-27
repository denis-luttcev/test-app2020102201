<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Simple IO client
 */
class FileServiceImpl implements IFileService
{
    /**
     * @var string
     */
    private $defaultPath;
    
    public function __construct($defaultPath) {
        $this->defaultPath = $defaultPath;
    }

    /**
     * Saves text content as local file
     * 
     * @param string $content
     * @param string $filename
     * @param string $path default if not specified
     * @return void
     */
    public function save(
            string $content,
            string $fullFilename,
            string $path = null
    ): void {
        $path = $path ?? $this->defaultPath;
        $placeDirs = substr($fullFilename, 0, strrpos($fullFilename, '/') + 1);
        $this->createDir("$path/$placeDirs");
        file_put_contents("$path/$fullFilename", $content);
    }
    
    private function createDir(string $dir): void
    {
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}
