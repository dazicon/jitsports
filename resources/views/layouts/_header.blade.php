<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <a href="{{ route('home') }}" id="logo">Jit Sports</a>
      <nav>
        <ul class="nav navbar-nav">
          <li><a href="#">篮球</a></li>
          <li><a href="#">网球</a></li>
          <li><a href="#">羽毛球</a></li>
          <li><a href="#">足球</a></li>
          <li><a href="#">乒乓球</a></li>
        </ul>
        <ul>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('users.index') }}">校友</a></li>

          @if (Auth::check())
            <a href="{{ route('users.show', Auth::user()->id) }}">
                <img src="{{ Auth::user()->gravatar('140') }}" alt="{{ Auth::user()->name }}" class="gravatar_header"/>
            </a>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('users.show', Auth::user()->id) }}">个人中心</a></li>
                <li><a href="{{ route('users.edit', Auth::user()->id) }}">编辑资料</a></li>
                <li class="divider"></li>
                <li>
                  <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                  </a>
                </li>
              </ul>
            </li>
          @else
          <li><a href="{{ route('help') }}">帮助</a></li>
          <li><a href="{{ route('signup') }}">注册</a></li>
          <li><a href="{{ route('login') }}">登录</a></li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>
