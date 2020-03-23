<?php
/**
 * Class Template
 */
namespace Services;

use Exception;

final class Template
{
    /**
     * Render template
     *
     * @param [type] $name
     * @param array $params
     * @return void
     */
    public static function render($name, $params = [])
    {
        $thisTemplate = new self();
        
        $template = $thisTemplate->getTemplate($name);
        
        $templateContent = file_get_contents($template);
        if(!empty($params)) {
            $templateContent = $thisTemplate->generateOptionalFields($templateContent, $params);
        }

        return $templateContent;
    }

    /**
     * Get template by name
     *
     * @param [type] $name
     * @return void
     */
    private function getTemplate($name)
    {
        $path = __DIR__ . "/../../templates/";
        $template = $path.$name.".html";
        
        if(!file_exists($template)) {
            throw new Exception("Template does not exist");
        }
        
        return $template;
    }

    /**
     * Generate optional fields for hiidden on form
     *
     * @param [type] $content
     * @param [type] $params
     * @return void
     */
    private function generateOptionalFields($content, $params)
    {
        $fields = "";
        $host = "";
        foreach($params as $key => $val) {
            if($key == 'host') {
                $host = $val;
            }
            $fields .= '<input type="hidden" name="'. $key .'" value="'. $val .'">';
        }

        $content = str_replace("{{divOptionalFieald}}", $fields, $content);
        $content = str_replace("{{host}}", $host, $content);

        return $content;
    }
}