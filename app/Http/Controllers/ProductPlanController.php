<?php

namespace App\Http\Controllers;

use App\Models\ProductPlan;
use Illuminate\Http\Request;

class ProductPlanController extends Controller
{
    /**
     * Display a list of plans asigned to a product.
     */
    public function getPlan(string $id)
    {
        $productplan = ProductPlan::where('product_id', $id)->with('plan')->get();

        if ($productplan) {
            return response()->json($productplan, 200);
        } else {
            return response()->json('Plan not found', 404);
        }
    }
}
