<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollectionResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollectionResource(Product::all());
    }

    public function create(Request $request)
    {
        return (new ProductResource(Product::create($request->all())))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $model = Product::find((int)$id);
        if ($model) {
            return new ProductResource($model);
        }
        return response()->json(['status' => 404, 'message' => 'Not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $model = Product::find((int)$id);
        if ($model) {
            $model->fill($request->all());
            $model->save();
            return (new ProductResource($model))
                ->response()
                ->setStatusCode(200);
        }
        return response()->json(['status' => 404, 'message' => 'Not found'], 404);
    }

    public function delete($id)
    {
        $model = Product::find((int)$id);
        if ($model) {
            if ($model->delete()) {
                return response()->json(['status' => 202, 'message' => 'Deleted'], 202);
            }
        }
        return response()->json(['status' => 404, 'message' => 'Not found'], 404);
    }
}
