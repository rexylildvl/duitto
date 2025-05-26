<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoSaveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-save-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
    $savings = Saving::all();

    foreach ($savings as $saving) {
        $shouldDeduct = false;

        switch ($saving->frequency) {
            case 'daily':
                $shouldDeduct = true;
                break;
            case 'weekly':
                $shouldDeduct = now()->dayOfWeek == 1; // Senin
                break;
            case 'monthly':
                $shouldDeduct = now()->day == 1;
                break;
        }

        if ($shouldDeduct && $saving->user) {
            // Kurangi saldo
            $saving->current_amount += $saving->amount_per_cycle;
            $saving->save();

            Transaction::create([
                'user_id' => $saving->user_id,
                'type' => 'expense',
                'amount' => $saving->amount_per_cycle,
                'description' => 'Otomatis: Tabungan "' . $saving->name . '"'
            ]);
        }
    }
}

}
