<?php

namespace Tests\Feature;

use Tests\CreatesApplication;

class ReservationTest extends \Illuminate\Foundation\Testing\TestCase
{
    use CreatesApplication;

    /** @test */
    public function it_can_create_a_reservation()
    {
        $this->withoutMiddleware();

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
        //$this->assertDatabaseHas('reservations', $reservationData);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->seed();
    }

    protected function tearDown(): void
    {
        $this->artisan('migrate:rollback'); // Rollback migrations
        parent::tearDown();
    }
}
