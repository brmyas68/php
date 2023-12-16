@extends('layouts/contentNavbarLayout')

@section('title', 'پروژه ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">پروژه ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست پروژه ها</h5>
            <div class="align-items-center">
                <form action="{{route("projects.ProjectsInfo")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
            <h6 class="btn btn-primary "><a class="text-white" href="{{route("projects.create")}}">ثبت آیتم جدید</a></h6>
        </div>

        @if(@\Illuminate\Support\Facades\Session::has('fails'))
            @include('share.messages.error')
        @endif

        @if(@\Illuminate\Support\Facades\Session::has('success'))
            @include('share.messages.success')
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table" style="text-wrap:wrap;">
                <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>عکس</th>
                    <th>عنوان</th>
                    <th>خدمت</th>
                    <th>کارفرما</th>
                    <th>گالری</th>
                    <th>نمایش در اسلایدر</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($projects))
                    @foreach($projects as $project)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td><img src="{{asset("storage/".$project->image)}}"  width="100px" height="100px" style="object-fit: cover;"/> </td>
                            <td>{{$project->subject}}</td>
                            <td>{{$project->Service->name}}</td>
                            <td>{{$project->Client->name}}</td>
                            <td><a href="{{route("galleries.projectGalleries",["id" => $project->id])}}">مشاهده</a></td>
                            <td>
                                @if($project->show_in_slider == \App\Enums\BoolStatus::yes)
                                    <i class="tf-icons bx bxs-check-circle"></i>
                                @else
                                    <i class="tf-icons bx bxs-no-entry"></i>
                                @endif
                            </td>
                            <td>{{convertDateToFarsi($project->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('projects.edit',['id'=>$project->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        <a class="dropdown-item" href="{{route('projects.destroy',['id'=>$project->id])}}"><i
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
                            $message="تاکنون پروژه ای ثبت نشده است";
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
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if(!$search)
                {{ $projects->links() }}
            @endif

        </div>
    </div>
@endsection
