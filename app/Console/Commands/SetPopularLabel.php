<?php

namespace App\Console\Commands;

use App\Models\InfoOrder;
use App\Models\Label;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SetPopularLabel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-popular-label';

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
        $products = Product::select('id', 'category_id')->get();
        $labelId = Label::where('code', 'popular')->pluck('id')->first();

        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                $productQuantity = InfoOrder::where('product_id', $product->id)->sum('quantity');
                $isLabel = ProductLabel::where('product_id', $product->id)->where('label_id', $labelId)->first();
                if ($productQuantity >= 10) {
                    if (!$isLabel) {
                        $productLabel = ProductLabel::create([
                            'product_id' => $product->id,
                            'label_id' => $labelId
                        ]);
                        Cache::forget('products' . $product->category_id);
                        Cache::forget('products'.'popular');

                        \Log::info($productLabel);
                    }
                } else {
                    if ($isLabel) {
                        $isLabel->delete();
                        Cache::forget('products' . $product->category_id);
                        Cache::forget('products'.'popular');

                        \Log::info("delete");
                    }
                }
            }
        }
    }
}
