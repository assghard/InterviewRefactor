<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_database_is_online()
    {
        $conn = $this->getConnection();
        $this->assertFalse(empty($conn));
    }
}
