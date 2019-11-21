<?php

namespace App\Http\Controllers;

use App\BookingRecord;
use App\Http\Requests\TicketsStoreRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    public function store(TicketsStoreRequest $request)
    {
        $ticket = Ticket::FindorFail(1);

        //check if the email address already used to book the same ticket
        if(BookingRecord::where("email",$request["email"])->where("ticket_type",$request["ticket_type"])->count())
        {
            //add error message to the user
            $errors['email'] = 'This email address already used to book a '. $request["ticket_type"] . ' ticket';
        }
        else
        {
            //check if there is available tickets
            if($request['ticket_type'] == 'student' && $ticket->student <= 0 )
            {
                Session()->flash('student_ticket', 'Sorry student tickets sold out');
            }
            elseif($request['ticket_type'] == 'normal' && $ticket->normal <= 0 )
            {
                Session()->flash('normal_ticket', 'Sorry normal tickets sold out');
            }
            else
            {
                //store booking information in the database
                BookingRecord::create($request->all());

                //check if the booked ticket is Student ticket and subtract 1 from the available tickets
                if ($request['ticket_type'] == 'student')
                {
                    $new_ticket = $ticket->student - 1;

                    $ticket->update(['student' => $new_ticket]);
                }
                //check if the booked ticket is Normal ticket and subtract 1 from the available tickets
                elseif ($request['ticket_type'] == 'normal')
                {
                    $new_ticket = $ticket->normal - 1;

                    $ticket->update(['normal' => $new_ticket]);
                }

                //if the ticket booked successfully send flash message to the user
                Session()->flash('booked_successfully', 'You have booked your ticket successfully');
            }

            return redirect()->back();
        }
        //return with errors message if any
        return redirect()->back()->withErrors($errors);
    }

    /*

     */
}
