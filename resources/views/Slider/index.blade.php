@extends('layouts/contentNavbarLayout')

@section('title', 'اسلایدر')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">اسلایدر /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست اسلایدر</h5>
            <h6 class="btn btn-primary "><a class="text-white" href="{{route("sliders.addProjectPage")}}">افزودن پروژه به اسلایدر</a></h6>
            <h6 class="btn btn-primary "><a class="text-white" href="{{route("sliders.create")}}">ثبت آیتم جدید</a></h6>
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
                    <th>عکس</th>
                    <th>عنوان</th>
                    <th>ترتیب نمایش</th>
                    <th>وضعیت</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($slides))
                    @foreach($slides as $slide)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>
                                @if($slide->project_id)
                                    <img src="{{asset("storage/".$slide->Project->image)}}" width="100px" height="100px">
                                @else
                                    @if($slide->type == \App\Enums\SliderType::image)
                                        <img src="{{asset("storage/".$slide->file)}}" width="100px" height="100px">
                                    @else
                                        <video width="150px" height="150px" controls>
                                            <source src="{{asset("storage/".$slide->file)}}" type="video/mp4" width="150px" height="150px" style="object-fit: cover"/>
                                        </video>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($slide->project_id)
                                    {{$slide->Project->subject}}
                                @else
                                    {{$slide->title}}
                                @endif
                            </td>
                            <td>{{$slide->order}}</td>
                            <td>
                                @if($slide->is_active == \App\Enums\BoolStatus::yes)
                                    {{"فعال"}}
                                @else
                                    {{"غیرفعال"}}
                                @endif
                            </td>
                            <td>{{convertDateToFarsi($slide->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        @if(!$slide->project_id)
                                            <a class="dropdown-item" href="{{route('sliders.edit',['id'=>$slide->id])}}"><i
                                                    class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        @endif
                                        <a class="dropdown-item" href="{{route('sliders.destroy',['id'=>$slide->id])}}"><i
                                                class="bx bx-trash me-2"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row">{{$counter}}</th>
                        <td></td>
                        <td></td>
                        <td style="color: red;font-weight: bold;">تاکنون اسلایدری ثبت نشده است</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif

                </tbody>
            </table>
            {{ $slides->links() }}

        </div>
    </div>
@endsection
