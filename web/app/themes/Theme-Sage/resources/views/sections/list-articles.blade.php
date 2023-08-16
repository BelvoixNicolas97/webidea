<section id="sectionListArticles">
    <div class="main">
        <h2><span>MASSA METUS PROIN</span>Dolor imperdiet</h2>
        <div class="content">
            <p>
                Phasellus risus turpis, pretium sit amet magna non, molestie ultricies enim. Nullam pulvinar felis at metus malesuada.
            </p>
        </div>
    </div>
    <ul class="menu">
        <li>
            <button id="pre">
                <img src="@asset('images/arrow.svg')" alt="Flèche de gauche" decoding="async" loading="lazy" />
                <img src="@asset('images/arrow-gray.svg')" alt="Flèche de gauche désactiver" decoding="async" loading="lazy" />
            </button>
        </li>
        <li>
            <button id="next">
                <img src="@asset('images/arrow.svg')" alt="Flèche de droite" decoding="async" loading="lazy" />
                <img src="@asset('images/arrow-gray.svg')" alt="Flèche de droite désactiver" decoding="async" loading="lazy" />
            </button>
        </li>
    </ul>
    <ul class="articles">
        @foreach($articles as $article)
            <li class="article {{ $article['id'] }}">
                <a href="{!! $article['link'] !!}">
                    @if ($article["img"]["url"])
                        <img src="{!! $article['img']['url'] !!}" alt="{!! $article['img']['alt'] !!}" decoding="async" loading="lazy" />
                    @else
                        <img src="@asset('images/default.jpg')" alt="Image par défaut" decoding="async" loading="lazy" />
                    @endif
                    <h4>{!! $article['titre'] !!}</h4>
                </a>
            </li>
        @endforeach
    </ul>
</section>