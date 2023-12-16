@extends('layouts/contentNavbarLayout')

@section('title', 'گالری')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('projects.ProjectsInfo')}}">پروژه ها</a> /</span> گالری </h4>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">گالری</h5> <small class="text-muted float-end"><a href="{{route('projects.ProjectsInfo')}}">بازگشت</a></small>
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

                    <form action="{{route('galleries.store')}}" method="post" enctype="multipart/form-data" class="d-flex align-items-center justify-content-start">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name" style="text-align: right">عکس</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <input type="hidden" name="projectId" value="{{$id}}">
                            <div class="col-sm-10 col-md-1">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive text-nowrap d-flex align-items-center justify-content-center flex-wrap m-3">

                        @if(count($galleries) > 0)
                            @foreach($galleries as $gallery)
                                <div class="m-3 shadow-lg">
                                    <a href="{{route("galleries.destroy",["id" => $gallery->id])}}"><i class="bx bx-trash text-danger"></i></a>
                                    <img src="{{asset("storage/".$gallery->image)}}" width="150px" height="150px"/>
                                </div>
                            @endforeach
                        @else
                            <div class="mt-4 p-2 bg-lighter text-danger text-center">{{"گالری خالی می باشد!"}}</div>
                        @endif

                        {{ $galleries->links() }}

                    </div>
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
