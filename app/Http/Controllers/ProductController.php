<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function search()
    {
        return response()->json("Hola");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Devuelve el contenido de todos los productos creados
     */
    public function index(Request $request)
    {
        // Para cargar la categoría y que no la muestre como número
        //$products = Product::orderBy('id', 'DESC')->paginate();
        $products = Product::limit(2)->paginate();
        //$products = Product::take(2)->get()->paginate();
        //$products = Product::all()->load('category');

        return response()->json([
           'code' => 200,
           'status' => 'Success',
           'products' => $products
        ],200);
    }


     /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * show method returns the product searched by id
     */
    public function show($id)
    {
        $product = Product::find($id)->load('category');

        if (is_object($product)){
            $data = [
                'code' => 200,
                'status' => 'Success',
                'product' => $product
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'Error',
                'message' => 'This product does not exists'
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * show method returns the product searched by id
     */
    public function getProductBySlug($slug)
    {
        $product = Product::find($slug);

        if (is_object($product)){
            $data = [
                'code' => 200,
                'status' => 'Success',
                'product' => $product
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'Error',
                'message' => 'This product does not exists'
            ];
        }
        return response()->json($data, $data['code']);
    }
}
