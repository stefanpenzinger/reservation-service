<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class ReservationTest extends TestCase
{
    use CreatesApplication;

    /**
     * Tests if the application can create a reservation
     * @test
     */
    public function it_can_create_a_reservation()
    {
        $this->withoutMiddleware();

        $reservationData = [
            'user_id' => 3,
            'status' => 'CHECKOUT',
            'start_time' => '2020-01-01 10:00:00',
            'end_time' => '2020-01-01 14:00:00',
            'loaction' => '4232 Hagenberg'
        ];

        $response = $this->json('POST', 'api/v1/reservations/', $reservationData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', $reservationData);
    }

    /**
     * Tests if the application can update a reservation
     * @test
     */
    public function it_can_update_a_reservation()
    {
        $this->withoutMiddleware();

        $reservation = Reservation::query()->firstOrFail();
        $reservationUpdateData = [
            'status' => 'CHECKOUT',
            'start_time' => '2020-01-01 10:00:00',
            'end_time' => '2020-01-01 14:00:00',
        ];

        $response = $this->json('PATCH', 'api/v1/reservations/' . $reservation->id, $reservationUpdateData);

        $response->assertStatus(204);
        $this->assertDatabaseHas('reservations', $reservationUpdateData);
    }

    /**
     * Tests if the application can delete a reservation
     * @test
     */
    public function it_can_delete_a_reservation()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->withoutMiddleware();

        $reservation = Reservation::query()->firstOrFail();
        $id = $reservation->id;

        $response = $this->json('DELETE', 'api/v1/reservations/' . $id);

        $response->assertStatus(204);
        Reservation::query()->findOrFail($id);
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
