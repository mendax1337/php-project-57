<?php

namespace Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testStrHelperWorks(): void
    {
        $this->assertSame('abc', Str::of('a')->append('bc')->value());
    }
}
