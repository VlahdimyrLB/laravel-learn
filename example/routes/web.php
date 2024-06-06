<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
    // $jobs = Job::all();

    // dd($jobs[0]->title);
});

Route::get('/jobs', function () {
    // $jobs = Job::all(); // <== causes N + 1 problem

    // eager loading - one single query
    // $jobs = Job::with('employer')->get();
    // $jobs = Job::with('employer')->paginate(3);
    // $jobs = Job::with('employer')->simplePaginate(5); // faster than paginate
    $jobs = Job::with('employer')->cursorPaginate(8); // fastest for big data but wont show page


    return view('jobs', [
        "jobs" => $jobs,
    ]);
});

Route::get('/job/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
