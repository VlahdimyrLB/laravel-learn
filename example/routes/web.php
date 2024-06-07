<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
    // $jobs = Job::all();

    // dd($jobs[0]->title);
});

// Index
Route::get('/jobs', function () {
    // $jobs = Job::all(); // <== causes N + 1 problem

    // eager loading - one single query
    // $jobs = Job::with('employer')->get();
    // $jobs = Job::with('employer')->paginate(3);
    $jobs = Job::with('employer')->latest()->simplePaginate(5); // faster than paginate
    // $jobs = Job::with('employer')->latest()->cursorPaginate(8); // fastest for big data but wont show page


    return view('jobs.index', [
        "jobs" => $jobs,
    ]);
});

// Go to Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show single Job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store to DB
Route::post('/jobs', function () {
    // validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // operate/execute
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    // redirect
    return redirect('/jobs');
});

// Go to Edit Page
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update to DB
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // authorize / have permission to update (on hold...)

    // update the job and persist
    $job = Job::findOrFail($id); // to abort if null
    // $job->title = request('title');
    // $job->salary = request('salary');
    // or
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // redirect
    return redirect('/jobs/' . $job->id);
});

// Destory to DB
Route::delete('/jobs/{id}', function ($id) {
    // authorize (onhold)

    // delete the Job
    $job = Job::findOrFail($id);
    $job->delete();
    // or simplier
    // Job::findOrFail($id)->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
