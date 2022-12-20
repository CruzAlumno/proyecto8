<header class="row bg-light justify-content-md-between main-header-container">
    <figure class="mt-3 col-12 col-md-8 d-flex align-items-center justify-content-center">
        <img class="logo-sizer" src="/assets/img/logo/logo_kvx.svg" alt="web-logo"/>
        <figcaption class="mt-3">EcoMaps</figcaption>
    </figure>
    <div class="col-12 col-md-4 d-flex justify-content-evenly align-items-center bg-dark">
        <a class="smooth-transition hover-item" href="/">Home</a>
        @if(!Auth::check())
            <a class="smooth-transition hover-item" href="/login">Login</a>
            <a class="smooth-transition hover-item" href="/register">Sing In</a>
        @else
            <a class="smooth-transition hover-item" href="/logout">Logout</a>
        @endif
    </div>
</header>
