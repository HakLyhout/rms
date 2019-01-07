<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class excel extends Model
{
    public $table ="data_report";
    public $fillable = ['data_id','report_id','date','view','interest_view'];
}
