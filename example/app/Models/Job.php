<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    // fields that can be fillable or mass assigned
    // protected $fillable = ['employer_id', 'title', 'salary'];

    // fields that should be guarded and cannot be mass assigned
    protected $guarded = [];    

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
};
