@extends('layouts/contentNavbarLayout')

@section('title', 'جزئیات رزومه')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('resumes.ResumesInfo')}}"> رزومه ها</a> /</span> جزئیات </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">جزئیات</h5> <small class="text-muted float-end"><a href="{{route('resumes.ResumesInfo')}}">بازگشت</a></small>
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
                    <div class="table-responsive text-nowrap p-3">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">نام</label>
                            <div class="col-sm-10">
                                <p>{{$resume->name}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">نام خانوادگی</label>
                            <div class="col-sm-10">
                                <p>{{$resume->last_name}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تاریخ تولد</label>
                            <div class="col-sm-10">
                                <p>{{$resume->birthday ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">جنسیت</label>
                            <div class="col-sm-10">
                                <p>
                                    @if($resume->sex == \App\Enums\Sex::female)
                                        {{"زن"}}
                                    @else
                                        {{"مرد"}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">شماره موبایل</label>
                            <div class="col-sm-10">
                                <p>{{$resume->mobile}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">ایمیل</label>
                            <div class="col-sm-10">
                                <p>{{$resume->email ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">آخرین عنوان شغلی</label>
                            <div class="col-sm-10">
                                <p>{{$resume->last_job_title ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">نام سازمان</label>
                            <div class="col-sm-10">
                                <p>{{$resume->organization_name ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">زمینه فعالیت سازمان</label>
                            <div class="col-sm-10">
                                <p>{{$resume->activity_in_organization ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تاریخ شروع</label>
                            <div class="col-sm-10">
                                <p>{{$resume->start_date ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تاریخ پایان</label>
                            <div class="col-sm-10">
                                <p>
                                    @if($resume->still_work == \App\Enums\BoolStatus::yes)
                                        {{"هنوز در این سازمان، در حال فعالیت می باشد"}}
                                    @else
                                        {{$resume->finish_date ?? "---"}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">توضیحات تکمیلی</label>
                            <div class="col-sm-10">
                                <p>{{$resume->description ?? "---"}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">پیوست فایل رزومه</label>
                            <div class="col-sm-10">
                                <p><a href="{{asset("storage/".$resume->resume)}}" target="_blank">مشاهده</a></p>
                                <p><a href="{{asset("storage/".$resume->resume)}}" download>دانلود</a></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">وضعیت رزومه</label>
                            <div class="col-sm-10">
                                @if($resume->status == \App\Enums\ResumeStatus::undefined)
                                    <p>تعیین وضعیت نشده</p>
                                @elseif($resume->status == \App\Enums\ResumeStatus::rejected)
                                    <p>رد شده در تاریخ {{convertDateToFarsi($resume->rejected_at)}}</p>
                                @else
                                    <p>تائید شده در تاریخ {{convertDateToFarsi($resume->confirmed_at)}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تعیین وضعیت</label>
                            <div class="col-sm-10">
                                <a class="bg-success text-white p-2 col-form-label"
                                   href="{{$resume->status == \App\Enums\ResumeStatus::confirmed ? "#" : route('resumes.updateStatusConfirmed',["id" => $resume->id])}}">تائید</a>
                                <a class="bg-danger text-white p-2 col-form-label"
                                   href="{{$resume->status == \App\Enums\ResumeStatus::rejected ? "#" : route('resumes.updateStatusRejected',["id" => $resume->id])}}">رد</a>
                            </div>
                        </div>
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
