@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش خدمت')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('services.ServicesInfo')}}">خدمات</a> /</span> ویرایش </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش</h5> <small class="text-muted float-end"><a href="{{route('services.ServicesInfo')}}">بازگشت</a></small>
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

                    <form action="{{route('services.update',['id'=>$service->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="نام" value="{{$service->name}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">عکس</label>
                            <div class="col-sm-10 col-md-6">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="col-sm-10 col-md-2">
                                <img src="{{asset("storage/".$service->image)}}" width="150px" height="150px" style="object-fit: cover"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">توضیحات</label>
                            <div class="col-sm-10">
                                <textarea id="short_text" placeholder="توضیحات" name="description"
                                          aria-label="توضیحات"
                                          aria-describedby="basic-icon-default-message2"
                                >{{$service->description}}</textarea>
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
