@extends('admin.layout.default')
@section('title')
    Verification
@endsection

@section('contents')
    <section class="auth-bg">
        <div class="row justify-content-center align-items-center g-0 w-100 h-100vh">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 px-5">
                <div class="card auth-wrapper">
                    <div class="logo">
                        <img src="{{ Helper::image_path('logo_dark.png') }}" alt="" srcset="">
                    </div>
                    <h4 class="text-secondary text-center fw-semibold text-capitalize mb-4">Enter Verification Code</h4>
                    <p class="text-center fw-semibold mb-2">We send you on mail.</p>
                    <small class="text-muted text-center">We’ve send you code on jone.****@company.com</small>
                    <form action="{{URL::to('verify')}}" method="POST" class="card-body pb-0">
                        @csrf
                        <div class="otp-input mb-3">
                            <input class="otp form-control" name="otp[]" type="text" oninput='digitValidate(this)'onkeyup='tabChange(1)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text" oninput='digitValidate(this)'onkeyup='tabChange(2)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text" oninput='digitValidate(this)'onkeyup='tabChange(3)'maxlength=1>
                            <input class="otp form-control" name="otp[]" type="text" oninput='digitValidate(this)'onkeyup='tabChange(4)'maxlength=1>
                            @error('otp') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2 mb-4">Continue</button>
                        <p class="text-center fw-semibold mb-3 fs-7">Did not receive the email? check your spam filter, or</p>
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-secondary w-100">Resend Code</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let digitValidate = function(ele) {
            console.log(ele.value);
            ele.value = ele.value.replace(/[^0-9]/g, "");
        };

        let tabChange = function(val) {
            let ele = document.querySelectorAll("input");
            if (ele[val - 1].value != "") {
                ele[val].focus();
            } else if (ele[val - 1].value == "") {
                ele[val - 2].focus();
            }
        };
    </script>
@endsection
