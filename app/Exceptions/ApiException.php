<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{

    protected $title;
    protected $message;
    protected $status;

    public function __construct(string $title = '', string $message = '', int $status = 400)
    {
        parent::__construct();
        $this->title = $title;
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function __toString()
    {
//        return get_class($this) ." " . $this->getTitle();
        $file = basename($this->getFile(), '.php');
        return json_encode([
            "code"    => "$file@{$this->getLine()}",
            "title"   => $this->getTitle(),
            "details" => $this->getMessage(),
            "trace"   => $this->getTraceAsString(),
        ]);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public function report()
    {
        //
    }

}
