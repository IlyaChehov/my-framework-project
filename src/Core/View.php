<?php

namespace Ilya\MyFrameworkProject\Core;

class View
{
    private FileTemplateLoad $load;
    private string $layout;
    private string $content;
    public function __construct(FileTemplateLoad $load, string $layout)
    {
        $this->load = $load;
        $this->layout = $layout;
    }

    public function render(string $content, array $data = [], string $layout = null): string
    {
        extract($data);
        $contentFullPath = $this->load->getFullPath($content);
        ob_start();
        require $contentFullPath;
        $this->content = ob_get_clean();
        $layout = $layout ?? $this->layout;
        $templateFullPath = $this->load->getFullPath("/layouts/{$layout}");
        require_once $templateFullPath;
        return '';
    }

    public function renderPartial(string $content, array $data = []): string
    {
        extract($data);
        $contentFullPath = $this->load->getFullPath($content);
        ob_start();
        require $contentFullPath;
        return ob_get_clean();
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
