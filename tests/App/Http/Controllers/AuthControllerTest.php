<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Tests for AuthController.
 *
 * @group Global
 * @group AuthController
 * @coversDefaultClass AuthController
 */
final class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /**
     * Тест успешной авторизации.
     *
     * @covers AuthController::login
     * @throws Exception
     */
    public function testLoginSuccess(): void
    {
        $password = $this->faker->password();
        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson(route('user.login', [
            'email' => $user->email,
            'password' => $password,
        ]));

        $response->assertOk()
            ->assertJsonStructure([
                'access_token',
                'token_type',
            ]);
    }

    /**
     * Тест авторизации. Неверные данные пользователя.
     *
     * @covers AuthController::login
     * @throws Exception
     */
    public function testWrongPasswordException(): void
    {
        $password = $this->faker->password();
        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson(route('user.login', [
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
        ]));

        $response->assertNotFound();
    }

    /**
     * Тест успешной авторизации.
     *
     * @covers AuthController::login
     * @throws Exception
     */
    public function testLogoutSuccess(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->postJson(route('user.logout'));

        $response->assertOk();
    }
}
