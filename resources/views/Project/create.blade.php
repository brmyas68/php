@extends('layouts/contentNavbarLayout')

@section('title', 'ثبت پروژه')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('projects.ProjectsInfo')}}">پروژه ها</a> /</span> ثبت </h4>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ثبت</h5> <small class="text-muted float-end"><a href="{{route('projects.ProjectsInfo')}}">بازگشت</a></small>
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

                    <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عکس شاخص (افقی)</label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عکس شاخص (عمودی)</label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="file" id="mobileImage" name="mobileImage">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">ویدئو معرفی</label>
                            <div class="col-sm-10 col-md-4">
                                <input class="form-control" type="file" id="video" name="video">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عنوان</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="عنوان"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">کارفرما</label>
                            <div class="col-sm-10">
                                <select name="clientId" class="form-control">
                                    <option>کارفرما را انتخاب کنید...</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">خدمت</label>
                            <div class="col-sm-10">
                                <select name="serviceId" class="form-control">
                                    <option>خدمت را انتخاب کنید...</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">نوع</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="type" class="form-control">
                                    <option value="doing">در حال انجام</option>
                                    <option value="done">انجام شده</option>
                                </select>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شروع پروژه</label>
                            <div class="col-sm-10 col-md-3">
                                <input type="text" class="form-control" name="startedAt" id="startedAt" placeholder="تاریخ شروع پروژه"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">اتمام پروژه</label>
                            <div class="col-sm-10 col-md-3">
                                <input type="text" class="form-control" name="finishedAt" id="finishedAt" placeholder="تاریخ اتمام پروژه"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">مدت زمان قرارداد (روز)</label>
                            <div class="col-sm-10 col-md-2">
                                <input type="text" class="form-control" name="contractDuration" id="contractDuration" placeholder="مدت زمان قرارداد (روز)"/>
                            </div>
                            <label class="col-sm-2 col-form-label" for="basic-default-company">پیمانکار هستید؟</label>
                            <div class="col-sm-10 col-md-3">
                                <input type="radio"  name="isContractor" id="isContractor" value="1" checked/>
                                <label class="col-sm-1 col-md-1 col-form-label" for="isContractor">بله</label>

                                <input type="radio"  name="isContractor" id="isContractor" value="0"/>
                                <label class="col-sm-1 col-md-8 col-form-label" for="isContractor">همکاری با پیمانکار دیگر</label>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">پیمانکار همکار</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="contractorId" class="form-control">
                                    <option value="">پیمانکار را انتخاب کنید...</option>
                                    @foreach($contractors as $contractor)
                                        <option value="{{$contractor->id}}">{{$contractor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">موقعیت</label>
                            <div class="col-sm-10 col-md-3">
                                <input type="text" class="form-control" name="location" id="location" placeholder="موقعیت مکانی"/>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">استان</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="provinceId" id="provinceSec" class="form-control">
                                    <option value="doing">استان را انتخاب کنید...</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شهر</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="cityId" id="citySec" class="form-control">
                                    <option value="">شهر را انتخاب کنید...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">توضیح مختصر</label>
                            <div class="col-sm-10">
                                <textarea id="context" name="summery"
                                          placeholder="توضیح مختصر"
                                          aria-label="توضیح مختصر"
                                          aria-describedby="basic-icon-default-message2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">توضیحات</label>
                            <div class="col-sm-10">
                                <textarea id="short_text" placeholder="توضیحات" name="description"
                                    aria-label="توضیحات"
                                          aria-describedby="basic-icon-default-message2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">نمایش در اسلایدر</label>
                            <div class="col-sm-10">
                                <input type="radio"  name="showInSlider" id="showInSlider" value="1"/>
                                <label class="col-sm-1 col-form-label" for="showInSlider">نمایش</label>

                                <input type="radio"  name="showInSlider" id="showInSlider" value="0" checked/>
                                <label class="col-sm-1 col-form-label" for="showInSlider">عدم نمایش</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">گالری پروژه</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="galleries[]" id="galleries" multiple/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">برچسب ها</label>
                            <div class="col-sm-10">
                                <select name="tagsList[]" class="form-control" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
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
