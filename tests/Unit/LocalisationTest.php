<?php

namespace Tests\Unit;

use Tests\TestCase;

class LocalisationTest extends TestCase
{
    public function test_russian() 
    {
        $this->assertEquals("Сотрудники", trans("Staff"));
    }
}
