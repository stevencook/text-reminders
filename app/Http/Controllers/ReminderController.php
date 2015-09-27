<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Reminder;
use Formatter;
use Input;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reminders = Auth::user()->reminders;
        $reminderCount = count($reminders);
        $reminderString = 'You have ';
        if ($reminderCount == 0) {
            $reminderString .= 'no reminders';
        } else if ($reminderCount == 1) {
            $reminderString .= $reminderCount . ' reminder';
        } else {
            $reminderString .= $reminderCount . ' reminders';
        }

        return view('reminders.list', [
            'reminders' => $reminders,
            'reminderCount' => $reminderCount,
            'reminderString' => $reminderString,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input
        $this->validate($request, [
            'date' => 'required|date',
            'message' => 'required|max:140',
        ]);

        try {

            // Create the reminder
            $date = Formatter::dateWebToDatabase(Input::get('date'));
            Auth::user()->reminders()->create([
                'message' => Input::get('message'),
                'fires_at' => $date,
            ]);

            return redirect()->action('ReminderController@index');

        } catch (\Exception $e) {
            return view('errors.500', array(
                'message' => $e->getMessage(),
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Verify that reminder belongs to current user
            $reminder = Auth::user()->reminders()->find($id);
            if (!$reminder) {
                throw new \Exception('Reminder not found');
            }

            return view('reminders.edit', [
                'reminder' => $reminder,
            ]);

        } catch (\Exception $e) {
            return view('errors.500', array(
                'message' => $e->getMessage(),
            ));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $this->validate($request, [
            'date' => 'required|date',
            'message' => 'required|max:140',
        ]);

        try {
            // Verify that reminder belongs to current user
            $reminder = Auth::user()->reminders()->find($id);
            if (!$reminder) {
                throw new \Exception('Reminder not found');
            }

            // Update the reminder
            $reminder->fires_at = Formatter::dateWebToDatabase(Input::get('date'));
            $reminder->message = Input::get('message');
            $reminder->save();

            return redirect()->action('ReminderController@index');

        } catch (\Exception $e) {
            return view('errors.500', array(
                'message' => $e->getMessage(),
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Verify that reminder belongs to current user
            $reminder = Auth::user()->reminders()->find($id);
            if (!$reminder) {
                throw new \Exception('Reminder not found');
            }
            $reminder->delete();

            return redirect()->action('ReminderController@index');

        } catch (\Exception $e) {
            return view('errors.500', array(
                'message' => $e->getMessage(),
            ));
        }
    }
}
