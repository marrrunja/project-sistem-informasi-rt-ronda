<?php

namespace Tests\Feature\auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testDoRegister(){

        $this->post('/register')->assertStatus(200);
    }
}
