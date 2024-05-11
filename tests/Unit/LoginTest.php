<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'nas123@gmail.com',
            'password' => bcrypt('nasya123456'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'nasya123456',
        ]);

        $response->assertStatus(200);
    }
}
