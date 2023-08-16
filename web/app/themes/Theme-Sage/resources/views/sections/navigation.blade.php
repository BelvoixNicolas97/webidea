<section id="sectionNavigation" class="">
    <div class="bar">
        <a class="logo" href="{!! $home_url !!}">
            <img src="{!! $logo_url['url'] !!}" alt="{!! $logo_url['alt'] !!}" decoding="async" loading="lazy">
        </a>
        <button id="burger">
            <img id="oppen" src="@asset('images/Nav.svg')" alt="Menu burger" decoding="async" loading="lazy">
            <img id="close" src="@asset('images/NavClose.svg')" alt="Menu burger ouvert" decoding="async" loading="lazy">
        </button>
    </div>
    <nav>
        @include('partials.navigation-items', $menu_un)
        @include('partials.navigation-items', $menu_deux)
    </nav>
</section>