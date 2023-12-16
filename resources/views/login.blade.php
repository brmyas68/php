@extends('layouts/blankLayout')

@section('title', 'ورود')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="{{route('loginPage')}}" class="app-brand-link gap-2"><i class='bx bx-log-in'></i> خوش آمدید </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">پنل ادمین</h4>
            <p class="mb-4"><i class='bx bxs-user-account'></i> ورود به حساب کاربری </p>
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

            <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">ایمیل یا نام کاربری</label>
                <input type="text" class="form-control" id="email" name="username"
                       placeholder="ایمیل یا نام کاربری را وارد کنید" value="{{old('username')}}" autofocus>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">رمزعبور</label>
                  <a href="{{ route("forgotPassword") }}">
                    <small>فراموشی رمزعبور؟</small>
                  </a>
                </div>
                <div class="input-group">
                  <input type="password" id="password" class="form-control" name="password"
                         placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                         aria-describedby="password" style="border-top-left-radius: 0;border-top-right-radius: 5px;
                         border-bottom-left-radius: 0;border-bottom-right-radius: 5px;"/>
                  <span class="input-group-text cursor-pointer" style="border-top-right-radius: 0;border-top-left-radius: 5px;
                  border-bottom-right-radius: 0;border-bottom-left-radius: 5px;border-right: 0;"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">ورود</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
  </div>
@endsection
