<?php

return [

    /**
     * All the settings that are related with the user seeding of the application.
     */

    'users' => [

        /**
         *  The list of basic backbone users in the application.
         */

        'all' => [['normal', 'user'], ['webmaster', 'user']],

        /**
         * The default admin(s) in the backbone from the application.
         * Email addresses are allowed here because the in_array check during the database seeds.
         *
         * @see UsersTableSeeder::isAdmin()
         */

        'webmasters' => ['webmaster@smtp.mailtrap.io'],
    ],

];
