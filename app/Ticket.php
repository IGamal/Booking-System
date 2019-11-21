<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //allow this attributes for mass-assignment
    protected $fillable = ['student', 'normal'];
}
