<?php
/**
 * Class Controller
 */
namespace Core;

class Controller
{
    /**
     * @param array $index
     * @return array
     */
    public static function get($index = null): array
    {
        $params = [];
        $get = $_GET;
        if(empty($get)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($get[$index])) {

                return $get[$index];
            }
        }

        foreach($get as $key => $val) {
            $params[$key] = $val;
        }

        return $params;

    }

    /**
     * @param array $index
     * @return array
     */
    public static function post($index = null): array
    {
        $params = [];
        $post = $_POST;
        if(empty($post)) {

            return $params;
        }
        if(!empty($index)) {

            if(isset($post[$index])) {

                return $post[$index];
            }
        }

        foreach($post as $key => $val) {
            $params[$key] = $val;
        }

        return $params;

    }
}