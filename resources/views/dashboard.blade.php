@extends('layouts/contentNavbarLayout')

@section('title', 'داشبورد')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-center text-info mb-2">پیام های ثبت شده روز</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$todayMessages}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-danger text-center mb-2">کامنت های ثبت شده روز</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$todayComments}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-success text-center mb-2">رزومه های ثبت شده روز</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$todayResumes}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-black text-center mb-2">رزومه های تعیین وضعیت نشده</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$undefinedResumes}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-gray text-center mb-2">کامنت های تائید نشده برای نمایش</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$notShowComments}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-primary text-center mb-2">کل پیام ها</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allMessages}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-info text-center mb-2">کل پروژه ها</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allProjects}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-danger text-center mb-2">کل کامنت ها</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allComments}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-success text-center mb-2">کل رزومه ها</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allResumes}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-black text-center mb-2">کل مشتریان ما</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allClients}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-gray text-center mb-2">کل خدمات ما</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allServices}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                            <div class="card-title">
                                <h6 class="text-wrap text-primary text-center mb-2">کل وبلاگ ها</h6>
                            </div>
                            <div class="mt-sm-auto">
                                <h3 class="mb-0">{{$allWeblogs}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
