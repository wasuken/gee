<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    //
    protected $fillable = ['corp_id', 'title', 'presentation_annual_income', 'occupation', 'work_location', 'contents'];
}
