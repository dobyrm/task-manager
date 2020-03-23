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
     * @param array $data
     * @return void
     */
    public static function render($view, $data = [])
    {
        extract($data, EXTR_SKIP);

        $file = dirname(__DIR__) . "/src/Views/" . $view . ".php";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
}