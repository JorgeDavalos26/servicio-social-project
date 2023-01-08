@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/signup_view.js'])
    
@endsection

@section("template")

    <div class="auth-card shadowed-card">
        <form id="form_signup">
            <h2>{{ __('Sign up in Paperworks system') }}</h2>
            <hr class="red"><br>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>{{ __('Username') }} *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="username" placeholder={{ __('Username') }} class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>{{ __('Email') }} *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="email" placeholder={{ __('Email') }} class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>{{ __('Password') }} *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="password" placeholder={{ __('Password') }} class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>{{ __('Confirm password') }} *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="password_confirmation" placeholder={{ __('Confirm password') }} class="w-100">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4 text-right">
                    <span><small>* {{ __('Required fields') }}</small></span>
                </div>
                <div class="col-8">
                    <button type="button" class="btn btn-success pull-right" onclick="signup()">{{ __('Sign up') }}</button>
                </div>
            </div>
        </form>
    </div>
    
@endsection