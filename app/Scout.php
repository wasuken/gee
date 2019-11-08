<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    //
    protected $fillable = ['corp_id', 'job_seeker_id', 'contents'];
}
