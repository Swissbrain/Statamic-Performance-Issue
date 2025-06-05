<?php

namespace App\Console\Commands;

use App\Models\Auth\User;
use App\Models\Quote;
use Illuminate\Console\Command;

class ClearUnusedQuotesCommand extends Command
{
    protected $signature = 'quotes:clean-up';

    protected $description = 'Removed not confirmed quotes that is older than 7 days';

    public function handle(): void
    {
        $quotes = Quote::whereNull('confirmed_at')
            ->whereDate('created_at', '<', now()->subDays(7))
            ->get();

        foreach($quotes as $quote) {
            $quote->items()->delete();
            $quote->delete();
        }
    }
}
