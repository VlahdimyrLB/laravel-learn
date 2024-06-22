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
