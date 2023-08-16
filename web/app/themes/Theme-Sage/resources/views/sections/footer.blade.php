<footer id="sectionFooter">
    <section class="logo">
        <img src="{!! $logo_url['url'] !!}" alt="{!! $logo_url['alt'] !!}" decoding="async" loading="lazy">
    </section>
    <section class="link">
        <nav id="menu_1">
            <ul class="list items">
                @foreach($menu_1 as $item)
                    <li class="item item {!! $item['id'] !!}">
                        <a href="{!! $item['url'] !!}">{!! $item["titre"] !!}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <nav id="menu_2">
            <ul class="list items">
                @foreach($menu_2 as $item)
                    <li class="item item {!! $item['id'] !!}">
                        <a href="{!! $item['url'] !!}">{!! $item["titre"] !!}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <nav id="reseaux">
            <ul class="list items">
                @foreach($menu_reseaux as $item)
                    <li class="item item {!! $item['id'] !!}">
                        <a href="{!! $item['url'] !!}">{!! $item["titre"] !!}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </section>
    <section class="contact">
        <h2>NOUS CONTACTER</h2>
        <a class="map" href="https://www.google.com/maps/place/2+Rue+Maurice+Barres,+57000+Metz/@49.1141531,6.1769763,17z/data=!3m1!4b1!4m6!3m5!1s0x4794dc1c9e6c7d33:0xc23597c9c094754d!8m2!3d49.1141531!4d6.1769763!16s%2Fg%2F11cpgy4gjd?entry=ttu" target="_blank" rel="noopener noreferrer">2, rue Maurice Barrès</br>57000 METZ</a>
        <a class="phone" href="tel:+33387521212">+33 3 87 52 12 12</a>
        <a class="mail" href="mailto:hello@webidea.fr">hello@webidea.fr</a>
    </section>
    <section class="subFooter">
        <h5 class="copyright">© 2020 Web Idea. Tous droits réservés.</h5>
        <div class="link">
            <a href="#">Mentions légales</a>
            <a href="#">Plan du site</a>
        </div>
    </section>
</footer>