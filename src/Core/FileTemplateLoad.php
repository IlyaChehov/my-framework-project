<?php

namespace Ilya\MyFrameworkProject\Core;

class FileTemplateLoad
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $basePath = trim($basePath, '/');
        $this->basePath = "/{$basePath}";
    }

    public function getFullPath(string $path): string
    {
        $fullPath = "{$this->basePath}/{$path}.php";
        if (!file_exists($fullPath)) {
            throw new \Exception("Шаблон {$fullPath} отсутствует");
        }
        return $fullPath;
    }

    public function exists(string $path): bool
    {
        return file_exists($path);
    }
}
