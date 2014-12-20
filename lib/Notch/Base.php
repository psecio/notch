<?php

namespace Notch;

class Base
{
	protected $di;

    public function __construct(\Pimple\Container $di)
    {
        $this->di = $di;
    }

    public function getDb()
    {
    	return $this->di['db'];
    }
}