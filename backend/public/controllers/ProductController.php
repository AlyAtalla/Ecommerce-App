<?php

namespace App\Controllers;

use App\Models\Product;
use App\Core\Request;


class ProductController
{
  public function index()
  {
    $products = Product::all();
    return response()->json($products);
  }

  public function show($id)
  {
    $product = Product::find($id);
    if ($product) {
      return response()->json($product);
    } else {
      return response()->json(['message' => 'Product not found'], 404);
    }
  }

  public function store(Request $request)
  {
    $product = new Product();
    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->save();

    return response()->json($product, 201);
  }

  public function update(Request $request, $id)
  {
    $product = Product::find($id);
    if ($product) {
      $product->name = $request->input('name');
      $product->description = $request->input('description');
      $product->price = $request->input('price');
      $product->save();

      return response()->json($product);
    } else {
      return response()->json(['message' => 'Product not found'], 404);
    }
  }

  public function destroy($id)
  {
    $product = Product::find($id);
    if ($product) {
      $product->delete();
      return response()->json(['message' => 'Product deleted']);
    } else {
      return response()->json(['message' => 'Product not found'], 404);
    }
  }
}