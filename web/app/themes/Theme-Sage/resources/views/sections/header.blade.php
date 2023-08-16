<header id="sectionHeader">
    <h1 class="titre">{!! $titre !!}</h1>
    <p class="extrait">
      {!! $extrait !!}
    </p>
    <div class="defilement">
        <p>Faites défiler</p>
    </div>
    <div class="imgHeader">
        @if ($img_header)
          <img src="{!! $img_header['url'] !!}" alt="{!! $img_header['alt'] !!}" decoding="async" loading="lazy"/>
        @else
          <img src=@asset("images/default.jpg") alt="Image du header par défaut" decoding="async" loading="lazy"/>
        @endif
    </div>
</header>
