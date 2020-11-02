<?php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->afterApplicationCreated([$this, 'beforeTest']);
    }

    protected function beforeTest()
    {
        // override
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
    }
}
