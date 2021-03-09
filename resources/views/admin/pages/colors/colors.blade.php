@extends('admin.layouts.master')
@section('css')
@toastr_css
@section('title')
قسم الالوان
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافه لون جديد
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    اضافه لون جديد
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>لون المنتج بالعربيه</th>
                                <th>لون المنتج بلانجليزيه</th>
                                <th> تاريخ الاضافه اللون</th>
                                <th>الاجرائات</th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($colors as $color)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>


                                <td>{{$color->getTranslation('name','ar')}}</td>
                                <td>{{$color->getTranslation('name','en')}}</td>

                                <td>{{ \Carbon\Carbon::parse($color->created_at)->diffForhumans() }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $color->id }}" title="{{ trans('Grades_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $color->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit color -->
                            <div class="modal fade" id="edit{{ $color->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                تعديل اللون
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('colors.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2"> سس اسم اللون بالعربيه
                                                            :</label>
                                                        <input id="Name" type="text" name="name_ar" class="form-control"
                                                            value="{{ $color->getTranslation('name', 'ar') }}" required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $color->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">اسم اللون بالانجليزيه
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $color->getTranslation('name', 'en') }}"
                                                            name="name_en" required>
                                                    </div>
                                                </div>

                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">غلق</button>
                                                    <button type="submit" class="btn btn-success">حفظ</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete color -->
                            {{-- <div class="modal fade" id="delete{{ $color->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                            id="exampleModalLabel">
                                            {{ trans('Grades_trans.delete_Grade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Grades.destroy', 'test') }}" method="post">
                                            {{ method_field('Delete') }}
                                            @csrf
                                            {{ trans('Grades_trans.Warning_Grade') }}
                                            <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $Grade->id }}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </div> --}}


                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!--   add color -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    اضافه لون جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('colors.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">ادخل اسم اللون بالعربيه
                                :</label>
                            <input id="Name" type="text" name="name_ar" class="form-control" autocomplete="off"
                                required>
                        </div>

                        <div class="col">
                            <label for="Name" class="mr-sm-2">ادخل اسم اللون بلانجليزيه
                                :</label>
                            <input id="Name" type="text" name="name_en" class="form-control" autocomplete="off"
                                required>
                        </div>

                    </div>

                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                <button type="submit" class="btn btn-success">اضافه لون للقسم</button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
