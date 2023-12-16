@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش اسلاید')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('sliders.SlidesInfo')}}">اسلایدها</a> /</span> ویرایش </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش</h5> <small class="text-muted float-end"><a href="{{route('sliders.SlidesInfo')}}">بازگشت</a></small>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="container">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if(@\Illuminate\Support\Facades\Session::has('fails'))
                        @include('share.messages.error')
                    @endif

                    @if(@\Illuminate\Support\Facades\Session::has('success'))
                        @include('share.messages.success')
                    @endif

                    <form action="{{route('sliders.update',['id'=>$slide->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">فایل حالت افقی</label>
                            <div class="col-sm-10 col-md-7">
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                            <div class="col-sm-10 col-md-3">
                                @if($slide->type == \App\Enums\SliderType::image)
                                    <img src="{{asset("storage/".$slide->file)}}" width="150px" height="150px">
                                @else
                                    <video width="150px" height="150px" controls>
                                        <source src="{{asset("storage/".$slide->file)}}" type="video/mp4" width="150px" height="150px" style="object-fit: cover"/>
                                    </video>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">فایل حالت عمودی</label>
                            <div class="col-sm-10 col-md-7">
                                <input class="form-control" type="file" id="mobileFile" name="mobileFile">
                            </div>
                            <div class="col-sm-10 col-md-3">
                                @if($slide->mobile_file)
                                    @if($slide->mobile_file_type == \App\Enums\SliderType::image)
                                        <img src="{{asset("storage/".$slide->mobile_file)}}" width="150px" height="150px">
                                    @else
                                        <video width="150px" height="150px" controls>
                                            <source src="{{asset("storage/".$slide->mobile_file)}}" type="video/mp4" width="150px" height="150px" style="object-fit: cover"/>
                                        </video>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">عنوان</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="title" name="title" placeholder="عنوان" value="{{$slide->title}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">لینک ارجاع</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="link" name="link" placeholder="لینک ارجاع" value="{{$slide->link}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">ترتیب نمایشی</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="order" name="order" placeholder="ترتیب نمایشی" value="{{$slide->order}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">وضعیت نمایشی</label>
                            <div class="col-sm-10">
                                <input type="radio"  name="isActive" id="isActive" value="1" @checked($slide->is_active == \App\Enums\BoolStatus::yes) />
                                <label class="col-sm-1 col-form-label" for="isActive">فعال</label>

                                <input type="radio"  name="isActive" id="isActive" value="0" @checked($slide->is_active == \App\Enums\BoolStatus::no) />
                                <label class="col-sm-1 col-form-label" for="isActive">غیرفعال</label>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic with Icons -->
    </div>

    <script>


        ClassicEditor
            .create(document.querySelector('#context'))


        ClassicEditor
            .create(document.querySelector('#short_text'))
    </script>
@endsection
