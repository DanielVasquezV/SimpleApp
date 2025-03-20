<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Mockery;

class GoogleOAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_handle_google_callback_with_existing_user()
    {
        $user = User::factory()->create([
            'external_id' => '123456789',
            'external_auth' => 'google',
            'email' => 'usuario@example.com',
        ]);

        $googleUser = Mockery::mock(\Laravel\Socialite\Two\User::class);
        $googleUser->shouldReceive('getId')->andReturn('123456789');
        $googleUser->shouldReceive('getEmail')->andReturn('exmple@mail.com');
        $googleUser->shouldReceive('getName')->andReturn('Joe Doe');
        $googleUser->shouldReceive('getAvatar')->andReturn('http://example.com/avatar.jpg');
        $googleUser->shouldReceive('getRaw')->andReturn([
            'given_name' => 'Joe',
            'family_name' => 'Doe',
            'verified_email' => true,
            'hd' => 'gmail.com',
            'locale' => 'es',
        ]);
    
        Socialite::shouldReceive('driver->user')->once()->andReturn($googleUser);
    
        $this->get('/auth/google/callback');
    
        $this->actingAs(User::where('email', 'usuario@example.com')->first());
        $this->assertAuthenticated();
    }
}