<?php

namespace Tests\Unit;

use App\Contact;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testOne()
    {
        $user = factory(User::class)->create();

        $topic = factory(Contact::class)->create();
        $dbTopic = $topic->find($user->id);
        $this->assertNotNull($user);
        $this->assertNotNull($topic);
        $this->assertTrue($dbTopic->id === $topic->id);
    }
}
