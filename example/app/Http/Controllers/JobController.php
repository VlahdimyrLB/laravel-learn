<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(5);

        return view('jobs.index', [
            "jobs" => $jobs,
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // operate/execute
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        // send email
        Mail::to($job->employer->user)->send(
            new JobPosted($job)
        );

        // redirect
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // inline authorization
        // if logged in
        // if (Auth::guest()) {
        //     return redirect('/login');
        // }
        // code above is now irrelevant because of the gate

        // if the authenticated user is the user created the job
        // is() used to compare
        // if ($job->employer->user->isNot(Auth::user())) {
        //     abort(403);
        // }
        // code snippet above is already inside the gate located in App Service Provider

        // alternative way using can and connot
        // if the user can edit the job
        // if (Auth::user()->can('edit-job', $job)) {
        //     dd('failure');
        // }
        // go to show.blade for reference

        // we can also use Gate::allows or denies
        // Gate::authorize('edit-job', $job);
        // removed the code because the middleware is defined in routes

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // authorize / have permission to update (on hold...)

        // update the job and persist
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // redirect
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize (onhold)

        // delete the Job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
