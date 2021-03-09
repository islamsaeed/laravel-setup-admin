@extends('admin.layouts.master')
@section('css')
@toastr_css
@section('title')
ملعومات المنتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافه ملعومات المنتج
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
    <div class="error">{{ $errors->first('name') }}</div>
    @endif



    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">
                        تعديل معلومات منتج الحالى
                    </h5>

                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="Name" class="mr-sm-2">تعديل اسم المنتح بالعربيه
                                    :</label>
                                <input type="text" name="name_ar" class="form-control" required
                                    value="{{$product->getTranslation('name','ar') }}">

                            </div>
                            <div class="col-6">
                                <label for="Name_en" class="mr-sm-2">تعديل اسم المنتح بالانجليزيه
                                    :</label>
                                <input type="text" class="form-control" name="name_en" required
                                    value="{{$product->getTranslation('name','en') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>اختر قسم المنتج :</label>
                                <select name="category_id" class="form-control" id="" required style="height: 55px;">
                                    <option value="" disabled selected>--اختر قسم المنتج--</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <br>





                        <div class="modal-footer show_relative">

                            <button type="submit" class="btn btn-success ">اضافه ملومات المنتج</button>

                        </div>



                    </form>


                </div>








            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
@toastr_js
@toastr_render



@endsection
