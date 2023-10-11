<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(
        public readonly array $product,
    )
    {
    }


    public function handle(): void
    {
        try {
            echo "Product created: {$this->product['id']}\n";
            print_r($this->product);
            Product::create($this->product);
        } catch (\Exception $exception) {
            echo "Product created: {$this->product['id']} failed\n";
        }
    }
}
