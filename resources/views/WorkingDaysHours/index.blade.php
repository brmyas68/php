@extends('layouts/contentNavbarLayout')

@section('title', 'روز و ساعت کاری شرکت')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">روز و ساعت کاری شرکت /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست روز و ساعت کاری شرکت</h5>
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
                    <th>روز</th>
                    <th>شروع کار</th>
                    <th>پایان کار</th>
                    <th>وضعیت</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @foreach($dayshours as $dayhour)
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td>{{$dayhour->day}}</td>
                        <td>{{$dayhour->start_work ? $dayhour->start_work : "--:--"}}</td>
                        <td>{{$dayhour->end_work ? $dayhour->end_work : "--:--"}}</td>
                        <td>
                            @if($dayhour->status == \App\Enums\DaysHoursStatus::open)
                                {{"باز"}}
                            @else
                                {{"بسته"}}
                            @endif
                        </td>
                        <td>{{convertDateToFarsi($dayhour->updated_at)}}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('dayshours.edit',['id'=>$dayhour->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $dayshours->links() }}

        </div>
    </div>
@endsection
