@extends('index')

@section('content')
<div class="container">
    <div id="content">
        <form action="{{ route('user.register') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>Đăng ký</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required class="form-control">
                    </div>

                    <div class="form-block">
                        <label for="fullname">Fullname*</label>
                        <input type="text" id="fullname" name="fullname" required class="form-control">
                    </div>

                    <div class="form-block">
                        <label for="address">Address*</label>
                        <input type="text" id="address" name="address" required class="form-control">
                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone" name="phone" required class="form-control">
                    </div>

                    <div class="form-block">
                        <label for="password">Password*</label>
                        <input type="password" id="password" name="password" required class="form-control">
                    </div>

                    <div class="form-block">
                        <label for="password_confirmation">Re-enter Password*</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
                    </div>

                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection
