<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
        "jobs" => [
            [
                "id" => 1,
                'title' => 'Director',
                'salary' => '100,000'
            ],
            [
                "id" => 2,
                'title' => 'Manager',
                'salary' => '50,000'
            ],
            [
                "id" => 3,
                'title' => 'Engineer',
                'salary' => '30,000'
            ]
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            "id" => 1,
            'title' => 'Director',
            'salary' => '100,000'
        ],
        [
            "id" => 2,
            'title' => 'Manager',
            'salary' => '50,000'
        ],
        [
            "id" => 3,
            'title' => 'Engineer',
            'salary' => '30,000'
        ]
    ];

    $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

    // dd($job);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});