<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Reminder;

class CheckReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if there are any reminders that we need to send.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // This would be a great place to remove code and
        // put into a package, so that the command simply
        // calls the package function.

        // Get unsent reminders
        $remindersToSend = Reminder::where('fires_at', '<=', new \DateTime('now'))
            ->where('fired_at', '=', NULL)
            ->get();

        // Send each reminder
        foreach ($remindersToSend as $reminder) {
            echo 'Sending text: ' . $reminder->message . "\n";

            // Send text message reminder
            $account_sid = env('TWILIO_ACCOUNT_SID', ''); // Your Twilio account sid
            $auth_token = env('TWILIO_AUTH_TOKEN', ''); // Your Twilio auth token

            $client = new Services_Twilio($account_sid, $auth_token);
            $message = $client->account->messages->sendMessage(
              env('TWILIO_PHONE_NUMBER', ''), // From a Twilio number in your account
              env('TEST_RECEIVE_PHONE_NUMBER', ''), // Text any number
              "Test message sent from Twilio!"
            );

            /*
                echo 'Sent from ' . env('TWILIO_PHONE_NUMBER', '') . '<br/>';
                print $message->sid;
            */

            // Record that we have sent this reminder
            $reminder->fired_at = new \DateTime('now');
            $reminder->save();
        }

    }
}
