<?php

use App\Enums\UserRoles;
use App\User;
use Faker\{Factory, Generator};
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        collect($this->applicationLogins())->each(function (array $name): void {
            [$firstname, $lastname] = $name;

            $data = $this->generateDataArray($name);
            $user = $this->createUser($data);

            if ($this->isWebmaster($user->email)) {
                $user->assignRole(UserRoles::WEBMASTER);
            }

            $user->assignRole(UserRoles::USER);
        });
    }

    private function generateDataArray($name): array
    {
        return [
            'firstname' => $name[0],
            'lastname' => $name[1],
            'email' => strtolower($name[0]) . '@' . config('mail.host'),
            'password' => 'password'
        ];
    }

    protected function isWebmaster(string $email): bool
    {
        return in_array($email, $this->applicationWebMasters(), true);
    }

    /**
     * Default application webmasters
     */
    private function applicationWebMasters(): array
    {
        return config('core.users.webmasters');
    }

    /**
     * Get the list of the standard members for the applications.
     * This list also allows us to create the basic login's) for the application backbone.
     */
    private function applicationLogins(): array
    {
        return config('core.users.all');
    }

    private function createUser(array $attributes = []): User
    {
        $person = $this->fakePerson();

        $userData = [
            'firstname' => $person['firstname'],
            'lastname' => $person['lastname'],
            'email' => $person['email'],
            'email_verified_at' => now(),
            'password' => $this->faker()->password
        ];

        return User::create($attributes + $userData);
    }

    private function fakePerson($firstname = '', $lastname = ''): array
    {
        $firstname = $firstname ?: $this->faker()->firstName;
        $lastname = $lastname ?: $this->faker()->lastName;

        $email = strtolower($firstname) . '.' . strtolower($lastname) . '@' . config('mail.host');

        return compact('firstname', 'lastname', 'email');
    }

    protected function faker(?string $locale = null): Generator
    {
        return Factory::create($locale ?? Factory::DEFAULT_LOCALE);
    }
}
