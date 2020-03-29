<?php


abstract class Entity
{
    /** @var mysqli */
    protected $database;

    /** @var array */
    protected $request;

    /**
     * Entity constructor.
     * @param array $request
     */
    public function __construct($request = [])
    {
        $this->database = new mysqli('database', 'lamp', 'lamp', 'lamp');
        $this->request = $request;
        $this->init();
    }

    abstract protected function init(): void;
}