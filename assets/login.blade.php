@extends('frontend.layout')
@section('pageHeading')
    {{ __('Singer Login') }}
@endsection
@php
  $metaKeywords = !empty($seo->meta_keyword_customer_login) ? $seo->meta_keyword_customer_login : '';
  $metaDescription = !empty($seo->meta_description_customer_login) ? $seo->meta_description_customer_login : '';
@endphp
@section('meta-keywords', "{{ $metaKeywords }}")
@section('meta-description', "$metaDescription")

@section('hero-section')
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="{{ asset('assets/admin/img/' . $basicInfo->breadcrumb) }}">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          
            {{ __('Customer Login') }}
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">
              
                {{ __('Customer Login') }}
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
@endsection
@section('content')
<style>
    .main-header{
        display: none !important;
    }
    
</style>
  <!-- LogIn Area Start -->
  <div class="login-area pt-15 pb-15 rpt-95  rpb-100">
    <div class="container-fluid">
      <div class="row justify-content-center">
          <!--<div class="col-lg-5 signup-bg"></div>-->
        <div class="col-lg-4 p-5 d-flex flex-column justify-content-center form-box">
            <div class="form-logo">
                <img class="img-fluid" src="{{ asset('assets/admin/img/65bf6934d8715.png') }}">
            </div>
            <div class="text-center">
                <h1 class="form-heading text-start mb-4 d-inline-block">Singer Login</h1>
            </div>
          @php
            $input = request()->input('redirected');
          @endphp
          @if (!onlyDigitalItemsInCart())
            @if ($input == 'checkout')
              <div class="form-group w-100">
                <a href="{{ route('shop.checkout', ['type' => 'guest']) }}"
                  class="btn btn-success d-block">{{ __('Checkout as Guest') }}</a>
              </div>
            @endif
          @endif


          <form id="login-form" name="login_form" class="login-form" action="{{ route('customer.authentication') }}"
            method="POST">
            @csrf

            @if ($basicInfo->facebook_login_status == 1 || $basicInfo->google_login_status == 1)
              <div class="form-group overflow-hidden">
                <div class="row justify-content-between mb-3">
                  @if ($basicInfo->facebook_login_status == 1)
                    <a class="text-center text-white {{ $basicInfo->google_login_status == 1 ? 'w-50' : 'w-100' }} pt-2 py-2 bg-facebook"
                      href="{{ route('auth.facebook') }}" class=""><i class="fab fa-facebook-f"></i>
                      {{ __('Login with Facebook') }}</a>
                  @endif

                  @if ($basicInfo->google_login_status == 1)
                    <a class="text-center text-white {{ $basicInfo->facebook_login_status == 1 ? 'w-50' : 'w-100' }}  pt-2 py-2 bg-google"
                      href="{{ route('auth.google') }}" class=""> <i class="fab fa-google"></i>
                      {{ __('Login with Google') }}</a>
                  @endif
                </div>
              </div>
            @endif

            @if (Session::has('success'))
              <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('alert'))
              <div class="alert alert-danger">{{ Session::get('alert') }}</div>
            @endif

            <div class="form-group">
              <label for="email">{{ __('Email') . ' *' }} </label>
              <input type="email" placeholder="{{ __('Enter Your Email') }}" name="email" id="email" >
              @error('email')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">{{ __('Password') . ' *' }}</label>
              <input type="password" name="password" id="password" placeholder="{{ __('Enter Password') }}">
              @error('password')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            @if ($basicInfo->google_recaptcha_status == 1)
              <div class="form-group">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            @endif

            <div class="form-group mb-0 text-center my-3">
              <button class="submit-btn br-30" type="submit"
                data-loading-text="Please wait..."><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-mic" width="14" height="16" viewBox="0 0 14 16"><path d="M3.6425 0C3.205 0 2.78833 0.0885417 2.3925 0.265625C1.99667 0.432292 1.65292 0.661458 1.36125 0.953125C1.06958 1.24479 0.835208 1.58854 0.658125 1.98438C0.491458 2.36979 0.408125 2.78646 0.408125 3.23438C0.408125 3.68229 0.491458 4.10417 0.658125 4.5C0.835208 4.89583 1.06958 5.23958 1.36125 5.53125C1.65292 5.82292 1.99667 6.05208 2.3925 6.21875C2.78833 6.38542 3.205 6.46875 3.6425 6.46875C4.09042 6.46875 4.51229 6.38542 4.90812 6.21875C5.30396 6.05208 5.64771 5.82292 5.93937 5.53125C6.23104 5.23958 6.46021 4.89583 6.62687 4.5C6.80396 4.10417 6.8925 3.68229 6.8925 3.23438C6.8925 2.78646 6.80396 2.36979 6.62687 1.98438C6.46021 1.58854 6.23104 1.24479 5.93937 0.953125C5.64771 0.661458 5.30396 0.432292 4.90812 0.265625C4.51229 0.0885417 4.09042 0 3.6425 0ZM5.06437 7.15625L10.9237 12.1406L12.3925 10.625L7.40812 4.85938C7.04354 5.54688 6.55917 6.10417 5.955 6.53125C5.36125 6.94792 5.06437 7.15625 5.06437 7.15625ZM13.2831 11.7656L12.705 10.9844L11.3456 12.4062L12.1269 12.9375L13.2831 11.7656ZM13.58 12.2344L12.5175 13.2656L13.0331 13.3594C13.0644 13.5052 13.08 13.7396 13.08 14.0625C13.0904 14.375 13.0071 14.6562 12.83 14.9062C12.705 15.0625 12.5383 15.1823 12.33 15.2656C12.1321 15.349 11.8925 15.3958 11.6112 15.4062C10.4237 15.4375 9.54354 15.3646 8.97062 15.1875C8.40812 15.0208 7.80396 14.5885 7.15812 13.8906C6.77271 13.4844 6.34042 13.1875 5.86125 13C5.38208 12.8125 4.92375 12.6927 4.48625 12.6406C4.05917 12.5781 3.68937 12.5573 3.37687 12.5781C3.07479 12.5885 2.90812 12.599 2.87687 12.6094C2.80396 12.6198 2.74146 12.6562 2.68937 12.7188C2.63729 12.7812 2.61646 12.8542 2.62687 12.9375C2.63729 13.0104 2.67375 13.0729 2.73625 13.125C2.79875 13.1771 2.87167 13.1979 2.955 13.1875C2.96542 13.1875 3.10604 13.1771 3.37687 13.1562C3.64771 13.1354 3.97583 13.151 4.36125 13.2031C4.74667 13.2552 5.15292 13.3594 5.58 13.5156C6.0175 13.6719 6.39771 13.9271 6.72062 14.2812C7.39771 15.0104 8.02792 15.4792 8.61125 15.6875C9.205 15.8958 9.97062 16 10.9081 16C11.0123 16 11.1269 16 11.2519 16C11.3769 16 11.5019 15.9948 11.6269 15.9844C12.0019 15.9844 12.33 15.9219 12.6112 15.7969C12.8925 15.6719 13.1217 15.4896 13.2987 15.25C13.5071 14.9583 13.6217 14.6458 13.6425 14.3125C13.6737 13.9792 13.6737 13.6979 13.6425 13.4688L13.7519 13.4844L13.58 12.2344Z" fill="#FED100"></path></svg> {{ __('Login') }}</button>
            </div>
            <div>
                <a href="#">{{ __('Login With Google') }}</a>
            </div>
            <div class="form-group mt-3 d-flex justify-content-between mb-0">
              <p>{{ __('Don`t have an account') . '?' }} <a class="other-page-link"
                  href="{{ route('customer.signup') }}">{{ __('Signup Now') }}</a></p>
              <p><a href="{{ route('customer.forget.password') }}" class="other-page-link">{{ __('Lost your password') . '?' }}</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- LogIn Area End -->
@endsection
