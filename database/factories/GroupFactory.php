<?php

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    return [
        'number_of_users' => rand(2, 100),
        'title' => 'group_title',
    ];
});
