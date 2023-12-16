@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش پروفایل شرکت')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('company.companyInfo')}}">پروفایل</a> /</span> ویرایش </h4>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش اطلاعات شرکت</h5> <small class="text-muted float-end"><a href="{{route('dashboardPage')}}">بازگشت</a></small>
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

                    <form method="post" action="{{route('company.update')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">لوگو</label>
                            <div class="col-sm-10 col-md-2">
                                <input class="form-control" type="file" id="logo" name="logo">
                            </div>
                            <div class="col-sm-10 col-md-3">
                                @if($company->logo)
                                    <img src="{{asset("storage/".$company->logo)}}" width="150px" height="150px" style="object-fit: cover"/>
                                @endif
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">فیلم</label>
                            <div class="col-sm-10 col-md-2">
                                <input class="form-control" type="file" id="film" name="film">
                            </div>
                            <div class="col-sm-10 col-md-3">
                                @if($company->film)
                                    <video width="150px" height="150px" controls>
                                        <source src="{{asset("storage/".$company->film)}}" type="video/mp4"/>
                                    </video>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">نام</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="name" id="name" placeholder="نام" value="{{$company->name}}"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">ایمیل</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="email" id="email" placeholder="ایمیل" value="{{$company->email}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">تلفن ثابت</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="تلفن ثابت" value="{{$company->phone}}"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">تلفن همراه</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="تلفن همراه" value="{{$company->mobile}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شعار</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="slogan" id="slogan" placeholder="شعار" value="{{$company->slogan}}"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شروع فعالیت</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="startYear" id="startYear" placeholder="سال شروع فعالیت" value="{{$company->start_year}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">لوکیشن</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="location" id="location" placeholder="لوکیشن" value="{{$company->location}}"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">آدرس</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="address" id="address" placeholder="آدرس" value="{{$company->address}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">روز و ساعت کاری</label>

                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شنبه تا چهارشنبه</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" class="form-control" name="saturdayToWednesday" id="saturdayToWednesday" placeholder="شنبه تا چهارشنبه"
                                       value="{{$company->saturday_to_wednesday}}"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">پنجشنبه</label>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" class="form-control" name="thursday" id="thursday" placeholder="پنجشنبه" value="{{$company->thursday}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">درباره ما</label>
                            <div class="col-sm-10">
                                <textarea id="short_text" placeholder="درباره ما" name="description"
                                          aria-label="درباره ما"
                                          aria-describedby="basic-icon-default-message2"
                                >{{$company->description}}</textarea>
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
