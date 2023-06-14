<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed();
    }

    /** @test */
    public function it_can_create_a_reservation()
    {
        $reservationData = [
            'user_id' => 3,
            'status' => 'CHECKOUT',
            'start_time' => '2020-01-01 10:00:00',
            'end_time' => '2020-01-01 14:00:00',
        ];

        $response = $this->json('POST', 'api/v1/reservations/', [
            'user_id' => 3,
            'status' => 'CHECKOUT',
            'start_time' => '2020-01-01 10:00:00',
            'end_time' => '2020-01-01 14:00:00',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', $reservationData);
    }

    protected function tearDown(): void
    {
        $this->artisan('migrate:rollback'); // Rollback migrations
        parent::tearDown();
    }
}
