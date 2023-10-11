<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function Laravel\Prompts\error;

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
        echo $this->product['id'];
        try {
            $id = $this->product['id'];
            Product::create([
                'id' => $id,
            ]);
            info('Product created with id: ' . $id);
        } catch (\Exception $exception) {
            error($exception->getMessage());
            throw new \Exception($exception->getMessage());
        }
    }
}
