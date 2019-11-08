<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function assertUserPair(User $a, User $b)
    {
        $this->assertSame($a->name,  $b->name);
        $this->assertSame($a->email, $b->email);
        $this->assertSame($a->password, $b->password);
        $this->assertSame($a->pr, $b->pr);
    }
}
