<?php

namespace Tests\Feature;
use App\Http\Controllers\Auth\GoogleOAuthController;
use App\Models\User;
use Tests\TestCase;


class CheckRoleTest extends TestCase{
    public function test_check_role_with_valid_email_domain()
    {
        $user = User::factory()->make([
            'email' => 'user@thecodeartisans.com',
        ]);

        $controller = new GoogleOAuthController();
        
        $result = $controller->checkRole($user);

        $this->assertTrue($result);
    }

    public function test_check_role_with_name_containing_qa()
    {
        $user = User::factory()->make([
            'name' => 'qaTester',
        ]);

        $controller = new GoogleOAuthController();

        $result = $controller->checkRole($user);

        $this->assertTrue($result);
    }

    public function test_check_role_with_specific_email()
    {
        $user = User::factory()->make([
            'email' => 'dvventura80@gmail.com',
        ]);

        $controller = new GoogleOAuthController();

        $result = $controller->checkRole($user);

        $this->assertTrue($result);
    }

    public function test_check_role_with_invalid_email_and_name()
    {
        $user = User::factory()->make([
            'email' => 'user@gmail.com',
            'name' => 'NormalUser',
        ]);

        $controller = new GoogleOAuthController();

        $result = $controller->checkRole($user);

        $this->assertFalse($result);
    }
}