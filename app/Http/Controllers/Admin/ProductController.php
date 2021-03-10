<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
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
        // $productImgs = ProductImg::all();

        return view('admin.pages.products.products', compact('products'));

    }

    // $categorys_ofProducts = Product::With(['categories' => function ($q) {
    //     $q->select('categories.id', 'categories.name');}])->get();

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
                'top_product' => $request->top_product,
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
    public function update(Request $request, $id)
    {

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en',
        ]);

        try {
            $product = Product::find($request->id)->update([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'created_at' => Carbon::now(),
                'top_product' => $request->top_product,
            ]);
            $post = Product::findOrFail($request->id);
            $postId = $post->id;

            $post->categories()->sync($request->category_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('edit_product_main_imgs', $postId); //product_id
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy()
    {

    }

    public function deleteAll(Request $request, $id)
    {
        if ($request->product_id) {
            try {

                $productcontent = Product::find($request->product_id);

                $productImg = $productcontent->productImage->pluck('id')->implode(',');

                // return $productcontent->productImage->pluck('id')->implode(',');

                $productcontent->delete();
                // ProductImg::find($productImg)->delete();

                toastr()->error(trans('messages.Delete'));
                return redirect()->route('products.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        } else {
            toastr()->error(trans('هناك خطاء حاول مره اخرى '));

            return redirect()->route('products.index');

        }

    }
}
