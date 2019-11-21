<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRecord extends Model
{
    //allow this attributes for mass-assignment
    protected $fillable = [ 'name', 'email','phone', 'ticket_type', 'created_at', 'updated_at'];
}
