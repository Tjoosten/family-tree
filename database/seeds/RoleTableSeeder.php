<?php

use App\Enums\UserRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class RoleTableSeeder
 */
class RoleTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Role::class)->create(['name' => UserRoles::WEBMASTER]);
        factory(Role::class)->create(['name' => UserRoles::USER]);
    }
}
