<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * Devuelve el contenido de todos los productos creados
     */
    public function index()
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
        $product = Product::find($slug)->load('category');

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
     * show method returns the product searched
     */
    public function getProductBySearch($search)
    {
        $product = Product::find($search)->load('category');

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Guarda un producto nuevo
     */
    public function store(Request $request)
    {
        // Recoger datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = \GuzzleHttp\json_decode($json, true);

        if (!empty($params_array)){
            
            // Validar datos
            $validate = \Validator::make($params_array, [
                'price' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'slug' => 'required'
            ]);

            // Guardar product
            if ($validate->fails()){
                $data = [
                    'code' => 400,
                    'status' => 'Error',
                    'message' => 'The product does not save'
                ];
            }else{
                $product = new Product();
                $product->price = $params->price;
                $product->description = $params->description;
                $product->category_id = $params->category_id;
                $product->slug = $params->slug;
                $product->save();

                $data = [
                    'code' => 200,
                    'status' => 'Success',
                    'product' => $product
                ];
            }
        }else{
            $data = [
                'code' => 400,
                'status' => 'Error',
                'message' => 'You do not send any product'
            ];
        }

        // Devolver resultado
        return response()->json($data, $data['code']);
    }
}
