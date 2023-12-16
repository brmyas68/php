@extends('layouts/contentNavbarLayout')

@section('title', 'رزومه ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">رزومه ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست رزومه ها</h5>
            <div class="align-items-center">
                <form action="{{route("resumes.ResumesInfo")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
            <form action="{{route('resumes.downloadResumes')}}" method="post" class="d-flex align-items-center justify-content-start">
                @csrf
                <div class="col-8">
                    <select name="status" class="form-control">
                        <option value="3">همه</option>
                        <option value="2">تائید شده ها</option>
                        <option value="1">رد شده ها</option>
                        <option value="0">تعیین وضعیت نشده ها</option>
                    </select>
                </div>
                <div class="col-8">
                    <button type="submit" class="btn btn-primary">دانلود PDF</button>
                </div>
            </form>
        </div>

        @if(@\Illuminate\Support\Facades\Session::has('fails'))
            @include('share.messages.error')
        @endif

        @if(@\Illuminate\Support\Facades\Session::has('success'))
            @include('share.messages.success')
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>جنسیت</th>
                    <th>شماره موبایل</th>
                    <th>وضعیت</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($resumes))
                    @foreach($resumes as $resume)
                        <tr style="background-color: @if($resume->is_seen == \App\Enums\BoolStatus::no) {{"#fcc6ce"}} @endif">
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$resume->name}}</td>
                            <td>{{$resume->last_name}}</td>
                            <td>
                                @if($resume->sex == \App\Enums\Sex::female)
                                    {{"زن"}}
                                @else
                                    {{"مرد"}}
                                @endif
                            </td>
                            <td>{{$resume->mobile}}</td>
                            @if($resume->status == \App\Enums\ResumeStatus::confirmed)
                                <td style="color: green">تائید شده</td>
                            @elseif($resume->status == \App\Enums\ResumeStatus::rejected)
                                <td style="color: red">رد شده</td>
                            @else
                                <td style="color: gray">تعیین وضعیت نشده</td>
                            @endif
                            <td>{{convertDateToFarsi($resume->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('resumes.detail',['id'=>$resume->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> جزئیات بیشتر</a>
                                        <a class="dropdown-item" href="{{route('resumes.destroy',['id'=>$resume->id])}}"><i
                                                class="bx bx-trash me-2"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @php
                        $message="";
                    @endphp
                    @if($search)
                        @php
                            $message="نتیجه ای یافت نشد";
                        @endphp
                    @else
                        @php
                            $message="تاکنون رزومه ای ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if(!$search)
                {{ $resumes->links() }}
            @endif

        </div>
    </div>
@endsection
