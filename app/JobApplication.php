<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    //
    protected $fillable = ['job_offer_id', 'job_seeker_id', 'checked'];
}
