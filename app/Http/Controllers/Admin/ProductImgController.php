<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImg;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::latest()->first()->id;

        try {

            $ProductImg = ProductImg::create([
                'code_img' => $request->code_img,
                'color_id' => $request->color_id,
                "tiny_img" => $request->tiny_img->store('product', 'public'),
                "max_img" => $request->max_img->store('gallery', 'public'),
                'product_id' => $request->product_id,
                'created_at' => Carbon::now(),

            ]);
            $ProductImg->colors()->attach($request->color_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function product_main_imgs()
    {$colors = Color::all();
        $products = Product::all();
        return view('admin.pages.products.img_product', compact('colors', 'products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductImg  $productImg
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImg $productImg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductImg  $productImg
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImg $productImg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductImg  $productImg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImg $productImg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductImg  $productImg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImg $productImg)
    {
        //
    }
}
