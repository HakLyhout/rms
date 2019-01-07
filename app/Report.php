<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $table="report_ad";
    public $fillable=['report_id','name','start_date','end_date'];
    //public $fillable=['view'];
    //public $fillable=['interest_view'];

}
