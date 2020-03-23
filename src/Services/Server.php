<?php
/**
 * Class Server
 */
namespace Services;

final class Server
{
    /**
     * Get serve host with server protocol
     *
     * @return string
     */
    public static function getServerHost()
    {
        $protocol = 'https://';
        $host = $_SERVER['HTTP_HOST'];

        return $protocol.$host;
    }
}