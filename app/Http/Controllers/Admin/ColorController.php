<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();

        return view('admin.pages.colors.colors', compact('colors'));

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
        if (Color::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate([
            'name_ar' => 'required|unique:colors,name->ar',
            'name_en' => 'required|unique:colors,name->en',
        ]);

        try {
            $color = Color::create([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'created_at' => Carbon::now(),
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('colors.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name_ar' => 'required|unique:colors,name->ar,' . $request->id,
            'name_en' => 'required|unique:colors,name->en,' . $request->id,

        ]);

        try {
            $color = Color::find($request->id)->update([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'created_at' => Carbon::now(),
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('colors.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
    }
}
