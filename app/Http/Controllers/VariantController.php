<?php

namespace App\Http\Controllers;

use App\Variant;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VariantController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * show method returns the variants searched by product_id
     */
    public function getVariantsOfProduct($product_id)
    {
        $variant = Variant::where('product_id','=', $product_id)->get()->load('Product');

        if (is_object($variant)){
            $data = [
                'code' => 200,
                'status' => 'Success',
                'variant' => $variant
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'Error',
                'message' => 'This variant does not exists'
            ];
        }
        return response()->json($data, $data['code']);
    }
}
