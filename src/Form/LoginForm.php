<?php
/**
 * Class LoginForm
 */
namespace Form;

use Services\Server;

class LoginForm
{
    /**
     * @var [object] $host
     */
    private $host;

    /**
     * Construct for LoginForm
     */
    public function __construct()
    {
        $this->host = Server::getServerHost();
    }

    /**
     * Render form
     */
    public function buildForm($optionalFields = null)
    {
        $fields = [
            'host'  => $this->host,
        ];

        foreach($optionalFields as $key => $val) {
            $fields[$key] = $val;
        }

        return $fields;
    }
}