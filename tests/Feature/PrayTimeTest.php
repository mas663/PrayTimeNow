<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrayTimeTest extends TestCase
{
    public function test_jadwal_sholat_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
