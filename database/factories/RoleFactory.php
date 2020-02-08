<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

$factory->define(Role::class, static function (Faker $faker): array {
    return ['name' => $faker->name];
});
