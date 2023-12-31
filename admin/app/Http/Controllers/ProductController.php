<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Jobs\ProductCreated;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            ProductCreated::dispatch($product->toArray());

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json($e->getMessage())->status(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(Product $product)
    {
        return response()->json($product)->status(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
