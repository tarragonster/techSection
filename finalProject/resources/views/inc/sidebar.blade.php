<link rel="stylesheet" href="css/sidebar.css" type="text/css">

<div id="mySidenav" class="sidenav">

    @if(Auth::check())
        @if(count($sidebars)>0)
            @foreach($sidebars as $sidebar)
                <div >
                    <h3><a href="/lists/{{$sidebar->list}}/practice">{{$sidebar->list}}</a></h3>
                </div>
            @endforeach
        @else
            <p>No lists found</p>
        @endif
    @else
        <div class="list-group-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </div>
    @endif
</div>

<div id="main">
    <div class="container">
        @include('inc.messages')

        @yield('content')
    </div>
    <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>

<script>
    var i = 0;

    function openNav() {
        i++;
        if(i%2 !== 0){
            document.getElementById("mySidenav").style.width = "226px";
            document.getElementById("main").style.marginLeft = "226px";
        }else{
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }

    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }
</script>
