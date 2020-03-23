<?php
/**
 * Class Request
 */
namespace Services;

final class Request
{
    /**
     * Collections get params
     *
     * @param [type] $index
     * @return void
     */
    public static function get($index = null)
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
     * Collections post params
     *
     * @param [type] $index
     * @return void
     */
    public static function post($index = null)
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