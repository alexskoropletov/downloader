<?php

use Faker\Generator as Faker;

$factory->define(App\Download::class, function (Faker $faker) {
    return [
        'url' => 'https://google.com',
        'status' => 0,
        'local_path' => 'test.txt',
    ];
});
