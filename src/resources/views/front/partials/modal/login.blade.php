<div class="ui modal sign-in modal-login" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="content">
        <div class="dialog">
            <a class="navbar-brand" href="{{route('default')}}">Top<span
                        class="navbar-brand--logo-mod">Di</span>Top
                H.O.M.E.</a>
            <h2>Sign in</h2>
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                @if ($errors->has('failed_login') && $errors->get('failed_login'))
                    <div class="alert alert-danger" role="alert">
                        {{ trans('auth.failed') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="firma">{{ trans('messages.email_address') }}:</label>
                    <input id="email" placeholder="E-mail" type="email" class="form-control" name="email"
                           value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                </div>
                <p>*{{ trans('messages.login_info') }}</p>
                <button class="click-button" href="#">Login</button>
            </form>
        </div>
    </div>
</div>
