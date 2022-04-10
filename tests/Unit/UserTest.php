<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\UserFactory;
use App\Models\User;
use App\Services\UserService;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_been_created()
    {
        $user = User::factory()->count(1)->create();
        $this->assertDatabaseCount('users', 1);

        $user = (new UserService)->createNewUser('test', 'test@test.com', 'P@s$word12345!');
        $this->assertDatabaseCount('users', 2);

        $this->assertTrue(User::where('email', $user->email)->count() == 1);
    }
}
