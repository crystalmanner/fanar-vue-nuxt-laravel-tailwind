<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Infinety\Filemanager\Http\Services\AbstractNamingStrategy;

class CustomNamingStrategy extends AbstractNamingStrategy
{
    public function name(string $currentFolder, UploadedFile $file): string
    {
        $filename = sprintf(
            '%s.%s',
            uniqid(),
            $file->getClientOriginalExtension()
        );
        return $filename;
    }
}