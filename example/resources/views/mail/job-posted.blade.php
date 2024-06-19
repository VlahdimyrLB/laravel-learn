<h2>
    {{ $job->title }}
</h2>

<p>
    Congrats! You job is now live in our website.
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View your Job Listings</a>
</p>
