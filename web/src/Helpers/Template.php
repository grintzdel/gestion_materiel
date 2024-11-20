<?php

namespace App\Helpers;

use Exception;

class Template
{
    /**
     * Render a template
     *
     * @param $templatePath string
     * @param $variables    array
     *
     * @return void
     *
     * @throws Exception
     */
    public static function renderTemplate(string $templatePath, array $variables = [])
    {
        extract($variables);

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            throw new Exception("Template not found: $templatePath");
        }
    }

}