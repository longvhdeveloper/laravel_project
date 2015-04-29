<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel Project</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            @if(!Sentry::check())
            <div class="nav-right sign-in-top">
                <a class="btn btn-default" href="{{URL::route('register_get')}}">Dang ky</a>
            </div>
            {{Form::open(array('route' => 'login_post', 'class' => 'navbar-form navbar-right'))}}
            <div class="form-group">
            {{Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Username'))}}
            </div>
            <div class="form-group">
            {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
            </div>
            {{Form::submit('Dang nhap', array('class' => 'btn btn-success'))}}
            {{Form::close()}}
            {{-- <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form> --}}
            @else
            <div class="dropdown navbar-right user-info">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                Xin chao {{Sentry::getUser()->username}}
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Profile</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::route('changepass_get')}}">Change password</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::route('logout_get')}}">Logout</a></li>
                </ul>
            </div>
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>