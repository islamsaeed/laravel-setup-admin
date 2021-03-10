<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImgController extends Controller
{

    public function store(Request $request)
    {

        $product = Product::latest()->first()->id;
        $multi_tiny_img = $request->file('tiny_img');
        $mulit_max_umg = $request->file('max_img');

        foreach ($multi_tiny_img as $tiny_img) {

            $image_min = $tiny_img->getClientOriginalName();
            $tiny_img->move(public_path('admin/img/'), $image_min);

        }
        foreach ($mulit_max_umg as $max_img) {

            $image_max = $max_img->getClientOriginalName();
            $max_img->move(public_path('admin/img/'), $image_max);

        } // end of the foreach

        try {

            $ProductImg = ProductImg::create([
                'code_img' => $request->code_img,
                'color_name' => $request->color_name,
                "tiny_img" => $image_min,
                "max_img" => $image_max,
                'product_id' => $product,
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
    {
        return view('admin.pages.products.img_product');
    }

    public function editproduct_main_imgs($id)
    {

        $productImgs = ProductImg::where('product_id', $id)->get();
        //  return $productImg = DB::table('product_imgs')->where('product_id', $id);

        return view('admin.pages.products.edit_img_product', compact('productImgs'));

    }

    public function updateproduct_main_imgs(Request $request, $id)
    {

        $oldimg = ProductImg::find($request->id);
        Storage::disk('public')->delete('/admin/img/', $oldimg->tiny_img);

        Storage::disk('public')->delete('/admin/img/', $oldimg->max_img);

        try {

            $ProductImg = ProductImg::find($request->id)->update([
                'code_img' => $request->code_img,
                'color_name' => $request->color_name,
                "tiny_img" => $request->tiny_img->store('product', 'public'),
                "max_img" => $request->max_img->store('gallery', 'public'),
                'product_id' => $request->product_id,
                'created_at' => Carbon::now(),

            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
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
