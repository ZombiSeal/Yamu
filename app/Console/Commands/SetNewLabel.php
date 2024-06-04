<?php

namespace App\Console\Commands;

use App\Models\InfoOrder;
use App\Models\Label;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SetNewLabel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-new-label';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::forget('products'.'new');
    }
}
