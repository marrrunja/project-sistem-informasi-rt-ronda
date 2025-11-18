<?php

namespace Tests\Feature\auth;

use Tests\TestCase;

use App\Services\Auth\AuthService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthServiceTest extends TestCase
{
    private AuthService $authService;

    protected function setUp():void{
        parent::setUp();
        $this->authService = $this->app->make(AuthService::class);
    }
    public function testNotNull(){
        self::assertNotNull($this->authService);
    }

    public function testSingleton()
    {
        $authService = $this->app->make(AuthService::class);
        self::assertSame($this->authService, $authService);
    }
}
