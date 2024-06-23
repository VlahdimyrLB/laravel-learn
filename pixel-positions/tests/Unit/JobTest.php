<?php

use App\Models\Employer;
use App\Models\Job;

test('it belongs to an employer', function () {
    // Arrange
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        "employer_id" => $employer->id, // overwrite employer
    ]);

    // Act and Assert
    expect($job->employer->is($employer))->toBeTrue();
});


it('can have tags', function () {
    // AAA
    $job = Job::factory()->create();

    $job->tag('Frontend');

    expect($job->tags)->toHaveCount(1);
});
