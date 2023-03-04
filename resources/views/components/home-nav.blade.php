<header id="home">
    <nav id="home-nav" class="container">
        <a href="{{route('routes.index')}}" class="home-nav-item @if($active === 1) active @endif">Routes</a>
        <a href="{{route('groups.index')}}" class="home-nav-item @if($active === 2) active @endif">Groups</a>
    </nav>
</header>
