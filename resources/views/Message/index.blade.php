@extends('layouts/contentNavbarLayout')

@section('title', 'پیام ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">پیام ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست پیام ها</h5>
            <div class="align-items-center">
                <form action="{{route("messages.index")}}" method="get" id="searchFormSec">
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
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل</th>
                    <th>عنوان پیام</th>
                    <th>تاریخ ثبت</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($messages))
                    @foreach($messages as $message)
                        <tr style="background-color: @if($message->is_seen == \App\Enums\BoolStatus::no) {{"#fcc6ce"}} @endif">
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$message->name}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->subject}}</td>
                            <td>{{convertDateToFarsi($message->created_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route("messages.show",["id" => $message->id])}}">بیشتر</a>
                                        <a class="dropdown-item" href="{{route('messages.destroy',['id'=>$message->id])}}"><i
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
                            $message="تاکنون پیامی ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if(!$search)
                {{ $messages->links() }}
            @endif

        </div>
    </div>
@endsection
