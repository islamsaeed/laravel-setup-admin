@extends('admin.layouts.master')
@section('css')
@toastr_css
@section('title')
صور لون المنتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافه صور ولون المنتج
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
                        اضافه صور و كود و لون المنتج جديد
                    </h5>

                </div>
                <div class="modal-body">



                    <form action="{{ route('product_img.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">

                                <label>كود المنتج:</label>
                                <input type="number" class="form-control" placeholder="ادخل كود المنتج" id="phone"
                                    name="code_img" required autocomplete="off">
                            </div>

                            <div class="form-group col-6">

                                <label>اختر لون المنتج</label>
                                <select name="color_id" class="form-control" id="" required style="height: 55px;">
                                    <option value="" disabled selected>--احتر لون المنتج--</option>
                                    @foreach ($colors as $color)
                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">

                                <label style="display: block; margin-bottom:5px">صوره منتج</label>
                                <input type="file" name="tiny_img">
                            </div>

                            <div class="form-group col-6 col-sm-12">

                                <label style="display: block; margin-bottom:5px">صوره لمعرض الاعمال </label>
                                <input type="file" name="max_img">

                            </div>
                        </div>

                        @if ($products && $products->count() > 0 ) <div class="row">
                            <div class="form-group col-6">

                                <label>اختر اسم المنتج</label>
                                <select name="product_id" class="form-control" id="" required style="height: 55px;">
                                    <option value="" disabled selected>--احتر اسم المنتج--</option>
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @else


                        <div class="alert alert-danger" role="alert">
                            <strong>من فضلتك قم بدخال اسم المنتج اولا</strong>
                            <a class=" btn btn-outline-info btn-sml" style="font-weight: 900"
                                href="{{ route('products.create') }}"> اضف ملعومات
                                المنتج </a> من هنا
                        </div>
                        @endif




                        @if ($products && $products->count() >0 )
                        <div class="modal-footer show_relative">

                            <button type="submit" class="btn btn-success ">اضافه صور المنتج</button>

                        </div>
                        @else
                        <button type="submit" class="btn btn-success " disabled>اضافه صور المنتج</button>
                        @endif

                    </form>
                </div>








            </div>
        </div>
    </div>
</div>

{{-- <style>
    .show_relative {
        position: relative;
    }

    #show_form {

        position: absolute;
        border-radius: 50%;
        font-size: 18px;
        line-height: 20px;
        font-weight: 800;

        bottom: 45%;

    }
</style> --}}

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
{{--

<script>
    $(document).ready(function() {

    $('#show_form').on('click',function () {
        // e.preventDefault();
          $('#sadon').toggle(1000);

      });

      });




$('#save_product').on('click',function (e) {
    e.preventDefault();
    var formData = new FormData($('#product_img_form')[0]);

       $.ajax({
            type: 'post',
            url: "{{route('product_img.store')}}",
data: formData,
processData: true,
contentType: true,
cache: false,
success:function (data) {

// $('tbody').html(data.table_data);
$('.code').text('');
$('#name_error').text('');
}
});


});










</script> --}}






@endsection
