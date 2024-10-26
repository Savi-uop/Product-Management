<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ExpireProducts extends Command
{
    protected $signature = 'products:expire';
    protected $description = 'Mark products older than 1 hour as expired';

    public function handle()
    {
        $expiredProducts = Product::where('status', 'active')
            ->where('created_at', '<=', Carbon::now()->subHour())
            ->update(['status' => 'expired']);

        $this->info($expiredProducts . ' product(s) have been marked as expired.');
    }
}
