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
                        اضافه معلومات منتج جديد
                    </h5>

                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="Name" class="mr-sm-2">ادخل اسم المنتح بالعربيه
                                    :</label>
                                <input type="text" name="name_ar" class="form-control" required>

                            </div>
                            <div class="col-6">
                                <label for="Name_en" class="mr-sm-2">ادخل اسم المنتح بالانجليزيه
                                    :</label>
                                <input type="text" class="form-control" name="name_en" required>
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
