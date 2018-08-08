<nav class="navbar navbar-expand navbar-inverse navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @role("keeper")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">管理</a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('users.index')}}">用户</a>
                          <a class="dropdown-item" href="{{route('departments.index')}}">车间</a>
                          <a class="dropdown-item" href="{{route('types.index')}}">类型</a>
                          <a class="dropdown-item" href="{{route('units.index')}}">单位</a>
                          <a class="dropdown-item" href="{{route('materials.index')}}">物料</a>
                          <a class="dropdown-item" href="{{route('records.index')}}">操作记录</a>
                        </div>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('in.index')}}">
                            入库
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('out.index')}}">
                            出库
                        </a>
                    </li>

                @endrole

                @auth
                    <li>
                        <a class="nav-link" href="{{route('department.index')}}">
                            我的车间
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('record.index')}}">
                            我的操作记录
                        </a>
                    </li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li>
                    <a class="nav-link" href="{{ route('login') }}">
                        登录
                    </a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">
                        {{ Auth::user()->name }}
                        <span class="caret">
                        </span>
                    </a>
                    <div aria-labelledby="navbarDropdown" class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            退出
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>