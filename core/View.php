<?php
/**
 * Class View
 */
namespace Core;

/**
 * View
 */
class View
{
    /**
     * @param string $view
     * @param array $response
     * @return void
     */
    public static function render($view, $response = [])
    {
        extract($response, EXTR_SKIP);

        $file = dirname(__DIR__) . "/src/Views/" . $view . ".php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}