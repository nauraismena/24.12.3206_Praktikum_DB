<?php

use Illuminate\Support\Facades\DB;

DB::table('categories')->insert([
    [
        'name' => 'Seminar',
        'slug' => 'seminar-it',
        'created_at' => now(),
        'updated_at' => now()
    ],
    [
        'name' => 'Entertainment',
        'slug' => 'entertainment',
        'created_at' => now(),
        'updated_at' => now()
    ],
    [
        'name' => 'Workshop',
        'slug' => 'workshop',
        'created_at' => now(),
        'updated_at' => now()
    ]
]);

