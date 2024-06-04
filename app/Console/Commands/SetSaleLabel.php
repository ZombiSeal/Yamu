<?php

namespace App\Console\Commands;

use App\Models\Label;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SetSaleLabel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-sale-label';

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
        $saleProducts = Product::select('id', 'category_id')->whereNotNull('sale_id')->get();
        $products = Product::select('id', 'category_id')->whereNull('sale_id')->get();
        $labelId = Label::where('code', 'sale')->pluck('id')->first();

        if(!$saleProducts->isEmpty()){
            foreach($saleProducts as $product){
                if(!ProductLabel::where('product_id', $product->id)->where('label_id', $labelId)->exists()){
                    $productLabel = ProductLabel::create([
                        'product_id' => $product->id,
                        'label_id' => $labelId
                    ]);
                    Cache::forget('products'.$product->category_id);
                    Cache::forget('products'.'sale');

                    \Log::info($productLabel);

                }
            }
        }

        if(!$products->isEmpty()){
            foreach($products as $product){
                $productLabel = ProductLabel::where('product_id', $product->id)->where('label_id', $labelId)->first();
                if($productLabel){
                    $productLabel->delete();
                    Cache::forget('products'.$product->category_id);
                    Cache::forget('products'.'sale');
                    \Log::info("delete");
                }
            }
        }
    }
}
