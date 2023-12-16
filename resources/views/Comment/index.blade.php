@extends('layouts/contentNavbarLayout')

@section('title', 'نظرات')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">نظرات /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست نظرات</h5>
            <div class="align-items-center">
                <form action="{{route("comments.index")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
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
                    <th>ایمیل</th>
                    <th>نظر</th>
                    <th>نوع نظر</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($comments))
                    @foreach($comments as $comment)
                        <tr style="background-color: @if($comment->is_seen == \App\Enums\BoolStatus::no) {{"#fcc6ce"}} @endif">
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->email}}</td>
                            <td>
                                @if(strlen($comment->comment) < 50)
                                    {{$comment->comment}}
                                @else
                                    {{substr($comment->comment,0,50)}} ...
                                @endif
                            </td>
                            <td>
                                @if($comment->type == \App\Enums\CommentType::project)
                                    {{"پروژه"}}
                                @else
                                    {{"وبلاگ"}}
                                @endif
                            </td>
                            @if($comment->is_show == \App\Enums\BoolStatus::yes)
                                <td class="text-success">{{"نمایش"}}</td>
                            @else
                                <td class="text-danger">{{"عدم نمایش"}}</td>
                            @endif
                            <td>{{convertDateToFarsi($comment->created_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('comments.show',['id'=>$comment->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> بیشتر</a>
                                        <a class="dropdown-item" href="{{route('comments.destroy',['id'=>$comment->id])}}"><i
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
                            $message="تاکنون نظری ثبت نشده است";
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
                {{ $comments->links() }}
            @endif

        </div>
    </div>
@endsection
