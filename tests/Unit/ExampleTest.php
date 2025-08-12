<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testAppHelperReturnsContainer(): void
    {
        $this->assertInstanceOf(
            \Illuminate\Contracts\Container\Container::class,
            app()
        );
    }
}
