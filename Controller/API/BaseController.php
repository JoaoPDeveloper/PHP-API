<?php

class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', ['HTTP/1.1 404 Not Found']);
    }

    /**
     * Get querystring params.
     */
    protected function getStringParams(): array
    {
        parse_str($_SERVER['QUERY_STRING'], $query);

        return $query;
    }

    /**
     * Send API output.
     */
    protected function sendOutput($data, $httpHeaders = [])
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }
}
