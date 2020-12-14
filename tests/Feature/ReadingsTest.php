<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reading;

class ReadingsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchAllReadings()
     {
         $this->json('GET', 'api/readings', ['Accept' => 'application/json'])
         ->assertStatus(200)
         ->assertJson([
             "status" => "success"
         ]);
     }

    public function testMarkNewsAsRead()
    {
        $this->json('POST', 'api/reading/update', [
            "reading_id" => 1,
        ])
        ->assertStatus(200)
        ->assertJson([
            "status" => "success"
        ]);
    }
}
