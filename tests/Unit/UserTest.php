<?php

namespace Tests\Unit;

use App\Contact;
use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUsers()
    {
        $users = factory(User::class, 100)->create();
        $this->assertNotNull($users);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUsersClient()
    {
        $users = factory(User::class, 3)
            ->create()
            ->each(function ($user) {
                $topic = $user->contact()->save(factory(Contact::class)->make());
                $this->assertTrue($user->id === $topic->id);
            });
    }
}
