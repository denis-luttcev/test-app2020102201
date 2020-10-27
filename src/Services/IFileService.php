<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Client API for IO operations
 */
interface IFileService 
{
    function save(
            string $content,
            string $fullFilename,
            string $path
    ): void;
}
