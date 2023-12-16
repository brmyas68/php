@extends('layouts/contentNavbarLayout')

@section('title', 'جزئیات')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">پیام ها /</span> جزئیات
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>جزئیات پیام</h5> <small class="text-muted float-end"><a href="{{route('messages.index')}}">بازگشت</a></small>
        </div>

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
                    <p>{{$message->name}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">ایمیل</label>
                <div class="col-sm-10">
                    <p>{{$message->email}}</p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">تاریخ ثبت</label>
                <div class="col-sm-10">
                    <p>{{convertDateToFarsi($message->created_at)}}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">عنوان پیام</label>
                <div class="col-sm-10">
                    <p>{{$message->subject}}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">پیام</label>
                <div class="col-sm-10">
                    <p>{{$message->description}}</p>
                </div>
            </div>

            @if($message->Child)
                <div class="row mb-3 bg-lighter">
                    <label class="col-sm-2 col-md-1 col-form-label bg-lighter text-danger text-center" for="basic-default-name">پاسخ ادمین</label>
                    <div class="col-sm-10">
                        <p><small class="text-muted float-end">({{convertDateToFarsi($message->Child->created_at)}})</small> {{$message->Child->description}}</p>
                    </div>
                </div>
            @endif

            @if(!$message->child)
                <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
                    <h5>ارسال ایمیل</h5>
                </div>
                <form action="{{route("messages.reply")}}" method="post">
                    @csrf
                    <input type="hidden" name="replyId" value="{{$message->id}}">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">موضوع ایمیل</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="موضوع ایمیل"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">متن ایمیل</label>
                        <div class="col-sm-10">
                                <textarea id="context" name="description"
                                          placeholder="متن ایمیل"
                                          aria-label="متن ایمیل"
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
@endsection
