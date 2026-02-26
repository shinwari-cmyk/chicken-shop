<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order; // ✅ Correct import for the model
use Carbon\Carbon;

class UpdateDailyWeight extends Command
{
    /**
     * The name and signature of the console command.
     *
     * You’ll run this command with:
     * php artisan app:update-daily-weight
     */
    protected $signature = 'app:update-daily-weight';

    /**
     * The console command description.
     */
    protected $description = 'Update daily weight for menu items automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 🕒 Get today’s day number (0–365)
        $day = Carbon::now()->dayOfYear;

        // 🌟 Example dynamic weights (you can change this formula)
        $baseWeights = [
            'Chicken Roll' => 0.75,
            'Chicken Burger' => 1.10,
            'Chicken Wings' => 0.95,
            'Chicken Qeema' => 0.85,
        ];

        foreach ($baseWeights as $item => $baseWeight) {
            // Weight changes slightly each day
            $newWeight = $baseWeight + (sin($day / 15) * 0.1);

            Order::where('item_name', $item)->update(['weight' => round($newWeight, 2)]);
        }

        $this->info('✅ All order weights updated successfully!');
    }
}
