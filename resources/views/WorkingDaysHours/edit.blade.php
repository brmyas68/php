@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش روز و ساعت کاری')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('dayshours.DaysHoursInfo')}}">روز و ساعت کاری</a> /</span> ویرایش </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش</h5> <small class="text-muted float-end"><a href="{{route('dayshours.DaysHoursInfo')}}">بازگشت</a></small>
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

                    <form action="{{route('dayshours.update',['id'=>$dayhour->id])}}" method="post">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">روز</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="day" id="day" placeholder="روز" value="{{$dayhour->day}}" disabled/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">شروع کار</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="startWork" id="startWork" placeholder="شروع کار" value="{{$dayhour->start_work}}"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">پایان کار</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" name="endWork" id="endWork" placeholder="پایان کار" value="{{$dayhour->end_work}}"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">وضعیت</label>
                            <div class="col-sm-10">
                                <label>باز</label><input class="m-2" type="radio" id="status" name="status" value="1"
                                @if($dayhour->status == \App\Enums\DaysHoursStatus::open) {{"checked"}} @endif>
                                <label>بسته</label><input class="m-2" type="radio" id="status" name="status" value="0"
                                @if($dayhour->status == \App\Enums\DaysHoursStatus::close) {{"checked"}} @endif>
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
