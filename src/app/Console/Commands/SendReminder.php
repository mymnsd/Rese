<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a reminder for reservations on the day of the reservation';
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
     * @return int
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        $reservations = Reservation::whereDate('start_at', $today)->get();

        foreach ($reservations as $reservation) {
            
            $userEmail = $reservation->user->email;

            $shopName = $reservation->shop->name;

            $messageContent = "ご予約当日になりました!\nご来店お待ちしております！\n\n";
            
            $messageContent .= "予約店名: " . $shopName . "\n";

            $messageContent .= "予約ID: " . $reservation->id . "\n";

            $messageContent .= "予約人数: " . $reservation->guest_count . "\n";

            $messageContent .= "予約開始時刻: " . $reservation->start_at->format('Y-m-d H:i:s') . "\n";

            try {
                Mail::raw($messageContent, function ($message) use ($userEmail) {
                    $message->to($userEmail)
                            ->subject('Reservation Reminder');
                    });
                $this->info("Reminder sent to $userEmail for reservation ID {$reservation->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder to $userEmail: " . $e->getMessage());
            }
        }

        $this->info('Reminders have been sent.');
    
        return 0;
        
    }
}