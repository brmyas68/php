@extends('layouts/contentNavbarLayout')

@section('title', 'دسته بندی ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">دسته بندی ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست دسته بندی ها</h5>
            <div class="align-items-center">
                <form action="{{route("categories.CategoriesInfo")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
            <h6 class="btn btn-primary "><a class="text-white" href="{{route("categories.create")}}">ثبت آیتم جدید</a></h6>
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
                    <th>دسته مادر</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                <form action="{{route('categories.totalDelete')}}" method="post">
                    @csrf
                    <div class="row justify-content-start">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">حذف دسته های انتخابی</button>
                        </div>
                    </div>
                    @if(count($categories) && !$search)
                        <x-categories :categories="$categories" />
                    @else
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">#</th>
                                <td @if($category->Parent)
                                    {{"style=padding-left:35px"}}
                                    @endif>
                                    <input type="checkbox" name="deletedIds[]" id="" value="{{$category->id}}" />
                                    @for($i=0 ; $i < $category->level; $i++)
                                        {{"-"}}
                                    @endfor
                                    &nbsp;&nbsp;{{$category->name}}
                                </td>
                                <td>
                                    @if($category->Parent)
                                        {{$category->Parent->name}}
                                    @else
                                        {{"---"}}
                                    @endif
                                </td>
                                <td>{{convertDateToFarsi($category->updated_at)}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('categories.edit',['id'=>$category->id])}}"><i
                                                    class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                            <a class="dropdown-item" href="{{route('categories.destroy',['id'=>$category->id])}}"><i
                                                    class="bx bx-trash me-2"></i> حذف</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </form>


                </tbody>
            </table>
            @if(count($categories) == 0)
                @php
                    $message="";
                @endphp
                @if($search)
                    @php
                        $message="نتیجه ای یافت نشد";
                    @endphp
                @else
                    @php
                        $message="تاکنون دسته جدیدی ثبت نشده است";
                    @endphp
                @endif
                <p style="color: red;font-weight: bold;text-align: center;padding: 10px 0;">{{$message}}</p>
            @endif
{{--            {{ $categories->links() }}--}}

        </div>
    </div>
@endsection
