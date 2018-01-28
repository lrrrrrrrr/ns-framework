<?php

namespace framework\Http;

class Response
{
    private $content;

    public function __construct($content, $status = 200)
    {
        $this->setContent($content);
    }

    public function sendContent()
    {
        echo $this->content;

        return $this;
    }

    /**
     * @param string $content
     * @return Response
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function send()
    {
        $this->sendContent();
    }
}