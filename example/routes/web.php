<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;


// Route::get('/', function () {
//     return view('home');
//     // $jobs = Job::all();
//     // dd($jobs[0]->title);
// });

// using Route::view(); for returning static view || shorthand of above code
Route::view('/', 'home');
Route::view('/contact', 'contact');


// apply the auth middle only in these routes
// we can also use except()
// Route::resource('jobs', JobController::class)->only(['index', 'show'])->middleware('auth');
// code commented because the single route declaration is better for these case

// NEW VERSION with Controller Classess
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}', [JobController::class, 'show'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

// means you need to be signed in and have the permission to edit the job ([authenticate, authorize])
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); // find the jobpolicy and run the edit function authorization

Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login'); // named routes
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// ROUTE GROUPING for refactoring
// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}',  'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });


// ROUTE RESOURCE - Magic!!!
// It automatically creates the necessary routes for index, create, store, show, edit, update, and destroy actions.
// also follows restful/resourceful operations
// 1st argument -> resource name/URI 2nd argument -> controller
// Route::resource('jobs', JobController::class);

// we can also specify the needed controllers in resource()
// use the third argument which is an array []
// we can use only or except to specify
// ex. below means generate recource without edit
// Route::resource('jobs', JobController::class, [
//     'except' => ['edit']
// ]);



// OLD VERSION for basis :)

// Index

// Route::get('/jobs', function () {
//     // $jobs = Job::all(); // <== causes N + 1 problem

//     // eager loading - one single query
//     // $jobs = Job::with('employer')->get();
//     // $jobs = Job::with('employer')->paginate(3);
//     $jobs = Job::with('employer')->latest()->simplePaginate(5); // faster than paginate
//     // $jobs = Job::with('employer')->latest()->cursorPaginate(8); // fastest for big data but wont show page

//     return view('jobs.index', [
//         "jobs" => $jobs,
//     ]);
// });


// Go to Create Page
// Route::get('/jobs/create', function () {
//     return view('jobs.create');
// });

// SHOW

// Route::get('/jobs/{id}', function ($id) {
//     $job = Job::find($id);

//     return view('jobs.show', ['job' => $job]);
// });

// ------ Route Model Binding -------
// wildcard{job} and param $job should be the same
// the wildcard represents the id in the db
// Route::get('/jobs/{job}', function (Job $job) {
//     return view('jobs.show', ['job' => $job]);
// });

// Store to DB
// Route::post('/jobs', function () {
//     // validation
//     request()->validate([
//         'title' => ['required', 'min:3'],
//         'salary' => ['required']
//     ]);

//     // operate/execute
//     Job::create([
//         'title' => request('title'),
//         'salary' => request('salary'),
//         'employer_id' => 1,
//     ]);

//     // redirect
//     return redirect('/jobs');
// });

// Go to Edit Page
// Route::get('/jobs/{job}/edit', function (Job $job) {
//     return view('jobs.edit', ['job' => $job]);
// });

// Update to DB

// Route::patch('/jobs/{id}', function ($id) {
//     // validate
//     request()->validate([
//         'title' => ['required', 'min:3'],
//         'salary' => ['required']
//     ]);

//     // authorize / have permission to update (on hold...)

//     // update the job and persist
//     $job = Job::findOrFail($id); // to abort if null
//     // $job->title = request('title');
//     // $job->salary = request('salary');
//     // or
//     $job->update([
//         'title' => request('title'),
//         'salary' => request('salary'),
//     ]);

//     // redirect
//     return redirect('/jobs/' . $job->id);
// });

// Route Model Binding way
// Route::patch('/jobs/{job}', function (Job $job) {
//     // validate
//     request()->validate([
//         'title' => ['required', 'min:3'],
//         'salary' => ['required']
//     ]);

//     // authorize / have permission to update (on hold...)

//     // update the job and persist
//     $job->update([
//         'title' => request('title'),
//         'salary' => request('salary'),
//     ]);

//     // redirect
//     return redirect('/jobs/' . $job->id);
// });

// Destory to DB

// Route::delete('/jobs/{id}', function ($id) {
//     // authorize (onhold)

//     // delete the Job
//     $job = Job::findOrFail($id);
//     $job->delete();
//     // or simplier
//     // Job::findOrFail($id)->delete();

//     // redirect
//     return redirect('/jobs');
// });

// Route Model Binding way
// Route::delete('/jobs/{job}', function (Job $job) {
//     // authorize (onhold)

//     // delete the Job
//     $job->delete();

//     // redirect
//     return redirect('/jobs');
// });
