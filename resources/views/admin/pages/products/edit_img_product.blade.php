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




                    @foreach ($productImgs as $pro)
                    <form action="{{ route('update_product_main_imgs','test') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('patch')




                        <input type="hidden" name="id" value="{{ $pro->id }}">
                        <input type="hidden" name="product_id" value="{{ $pro->product_id }}">
                        <div class="row">
                            <div class="form-group col-6">

                                <label>كود المنتج:</label>
                                <input type="number" class="form-control" placeholder="ادخل كود المنتج" id="phone"
                                    name="code_img" required autocomplete="off" value="{{ $pro->code_img }}">
                            </div>

                            <div class="form-group col-6">

                                <label>اختر لون المنتج</label>
                                <input name="color_name" class="form-control" type="text" required
                                    placeholder="ادخل لون المنتج" value="{{ $pro->color_name }}">


                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">

                                @foreach ([$pro->tiny_img] as $img)


                                <img style="height:90px; width:100px;" src="{{ asset('admin/img/'.$img) }}" alt="">
                                @endforeach
                                <br>
                                <label style="display: block; margin-bottom:5px">صوره منتج</label>
                                <input type="file" name="tiny_img">
                            </div>

                            <div class="form-group col-6 col-sm-12">
                                <img style="height:90px; width:100px;" src="{{ asset('admin/img/'.$pro->max_img) }}"
                                    alt="">
                                <br>
                                <label style="display: block; margin-bottom:5px">صوره لمعرض الاعمال </label>
                                <input type="file" name="max_img">

                            </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-success ">تعديل صور المنتج</button>
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
