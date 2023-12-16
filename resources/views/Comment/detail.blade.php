@extends('layouts/contentNavbarLayout')

@section('title', 'جزئیات نظر')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('comments.index')}}"> نظرات</a> /</span> جزئیات </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">جزئیات</h5> <small class="text-muted float-end"><a href="{{route('comments.index')}}">بازگشت</a></small>
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
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">کاربر</label>
                            <div class="col-sm-10">
                                <p>{{$comment->name}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">ایمیل</label>
                            <div class="col-sm-10">
                                <p>{{$comment->email}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">وضعیت</label>
                            @if($comment->is_show == \App\Enums\BoolStatus::yes)
                                <label class="col-sm-3 col-form-label text-success" for="basic-default-name">{{"نمایش"}}</label>
                                <label class="col-sm-5 col-form-label text-black" for="basic-default-name">نمایش در :
                                    {{convertDateToFarsi($comment->show_at)}}</label>
                            @else
                                <label class="col-sm-8 col-form-label text-danger" for="basic-default-name">{{"عدم نمایش"}}</label>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تاریخ ثبت</label>
                            <div class="col-sm-10">
                                <p>{{convertDateToFarsi($comment->created_at)}}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تعیین وضعیت</label>
                            <div class="col-sm-10">
                                <a class="bg-lighter text-success p-2 col-form-label"
                                   href="{{$comment->is_show == \App\Enums\BoolStatus::yes ? "#" : route('comments.updateShowStatusShow',["id" => $comment->id])}}">نمایش در وبسایت</a>
                                <a class="bg-lighter text-danger p-2 col-form-label"
                                   href="{{$comment->is_show == \App\Enums\BoolStatus::no ? "#" : route('comments.updateShowStatusNotShow',["id" => $comment->id])}}">عدم نمایش در وبسایت</a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">نوع</label>
                            <div class="col-sm-10">
                                <p>
                                    @if($comment->type == \App\Enums\CommentType::project)
                                        {{"پروژه"}} / {{$comment->type}}
                                    @else
                                        {{"وبلاگ"}} / {{$comment->type}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">اطلاعات <br> {{$comment->type}}</label>
                            <div class="col-sm-10">
                                @if($comment->type == \App\Enums\CommentType::weblog)
                                    <p>{{$comment->Weblog->subject}}</p>
                                @else
                                    <p>{{$comment->Project->subject}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">نظر</label>
                            <div class="col-sm-10">
                                <p>{{$comment->comment}}</p>
                            </div>
                        </div>

                        @php
                            $adminReply=$comment->AdminReply;
                        @endphp
                        @if($adminReply)
                            <div class="row mb-3 bg-lighter">
                                <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">پاسخ ادمین</label>
                                <div class="col-sm-10">
                                    <p><small class="text-muted float-end">({{convertDateToFarsi($adminReply->created_at)}})</small>
                                        {!! $adminReply->comment !!}</p>
                                    @if($adminReply->is_show == \App\Enums\BoolStatus::yes)
                                        <label class="col-sm-3 col-form-label text-success" for="basic-default-name">{{"نمایش"}}</label>
                                        <label class="col-sm-5 col-form-label text-black" for="basic-default-name">نمایش در :
                                            {{convertDateToFarsi($adminReply->show_at)}}</label>
                                    @else
                                        <label class="col-sm-8 col-form-label text-danger" for="basic-default-name">{{"عدم نمایش"}}</label>
                                    @endif
                                    <a class="bg-lighter text-success p-2 col-form-label"
                                       href="{{$adminReply->is_show == \App\Enums\BoolStatus::yes ? "#" : route('comments.updateShowStatusShow',["id" => $adminReply->id])}}">نمایش پاسخ در وبسایت</a>
                                    <a class="bg-lighter text-danger p-2 col-form-label"
                                       href="{{$adminReply->is_show == \App\Enums\BoolStatus::no ? "#" : route('comments.updateShowStatusNotShow',["id" => $adminReply->id])}}">عدم نمایش پاسخ در وبسایت</a>
                                    <a class="bg-lighter text-info p-2 col-form-label"
                                       href="{{route('comments.destroy',["id" => $adminReply->id])}}">حذف</a>
                                </div>
                            </div>
                        @endif

                        @if(!$adminReply)
                            <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
                                <h5>ارسال ایمیل و ثبت نظر</h5>
                            </div>
                            <form action="{{route("comments.reply")}}" method="post">
                                @csrf
                                <input type="hidden" name="replyId" value="{{$comment->id}}">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">متن پاسخ نظر</label>
                                    <div class="col-sm-10">
                                <textarea id="context" name="comment"
                                          placeholder="متن پاسخ نظر"
                                          aria-label="متن پاسخ نظر"
                                          aria-describedby="basic-icon-default-message2"
                                ></textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">ارسال ایمیل</button>
                                    </div>
                                </div>
                            </form>
                        @endif
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
