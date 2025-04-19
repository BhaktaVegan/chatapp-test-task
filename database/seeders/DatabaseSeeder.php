<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Сидер БД.
 */
final class DatabaseSeeder extends Seeder
{
    /**
     * Сидер БД приложения.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChatSeeder::class,
        ]);
    }
}
