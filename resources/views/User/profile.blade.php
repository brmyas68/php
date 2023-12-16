@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش پروفایل کاربر')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('user.userInfo')}}">پروفایل</a> /</span> ویرایش </h4>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش اطلاعات کاربری</h5> <small class="text-muted float-end"><a href="{{route('dashboardPage')}}">بازگشت</a></small>
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

                    <form action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عکس</label>
                            <div class="col-sm-10 col-md-7">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="col-sm-10 col-md-3">
                                @if($user->image)
                                    <img src="{{asset("storage/".$user->image)}}" width="150px" height="150px" style="object-fit: cover"/>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام و نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="نام و نام خانوادگی" value="{{$user->name}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" placeholder="ایمیل" value="{{$user->email}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام کاربری</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری"
                                       value="{{$user->username}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">رمزعبور</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" class="form-control" name="password" id="password" placeholder="رمزعبور"
                                       value=""/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">تایید رمزعبور</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="تایید رمزعبور"
                                       value=""/>
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
        document.getElementById('past_amount_box').style.display = 'none';
        const toggleHasOff = (event) => {
            if (event.target.checked) {
                document.getElementById('past_amount_box').style.display = 'flex';
            } else {
                document.getElementById('past_amount_box').style.display = 'none';
            }
        }

        ClassicEditor
            .create(document.querySelector('#context'))


        ClassicEditor
            .create(document.querySelector('#short_text'))
    </script>
@endsection
