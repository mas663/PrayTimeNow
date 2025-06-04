<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrayTimeFeatureTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function homepage_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('Cari Jadwal');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function form_validation_works()
    {
        $response = $this->post('/praytime', []);
        $response->assertSessionHasErrors(['city', 'date']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function form_can_accept_valid_input()
    {
        $response = $this->post('/praytime', [
            'city' => 'Surabaya',
            'date' => '2024-01-01'
        ]);

        // Tidak mengecek view karena fetch data dari API
        $response->assertStatus(200);
        $response->assertSeeText('Jadwal Sholat untuk');
    }
}
