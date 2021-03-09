<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImg;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();
        $productImgs = ProductImg::all();

        // $categorys_ofProducts = Product::With(['categories' => function ($q) {
        //     $q->select('categories.id', 'categories.name');}])->get();

        return view('admin.pages.products.products', compact('products', 'productImgs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = Color::all();
        $categories = Category::all();

        return view('admin.pages.products.create', compact('colors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Product::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en',
        ]);

        try {
            $product = Product::create([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'created_at' => Carbon::now(),
            ]);
            $product->categories()->attach($request->category_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('product_main_imgs');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {

        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.pages.products.edit', compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (Product::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar,except', $request->id,
            'name_en' => 'required|unique:categories,name->en,except', $request->id,
            'category_id' => 'required',
        ]);
        try {
            $category = Category::findOrFail($request->id)->update([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'category_id' => $request->category_id,

                'created_at' => Carbon::now(),
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
