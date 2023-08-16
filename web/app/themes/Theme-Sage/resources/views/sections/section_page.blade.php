@if (isset($error))
    <section id="sectionPage" class="error">
        <h2 class="titre">{!! $error !!}</h2>
    </section>
@else
    <section id="sectionPage" class="page_{!! $id !!}">
        <div class="main">
            <h2 class="titre"><span>{!! $preview !!}</span>{!! $titre !!}</h2>
            <div class="content">
                {!! $content !!}
            </div>
            <a class="link" href="{!! $link !!}">Découvrez le service</a>
        </div>
        <div class="imgHeader">
            @if($img['url'] !== false)
                <img src="{!! $img['url'] !!}" alt="{!! $img['alt'] !!}" decoding="async" loading="lazy"/>
            @else
                <img src=@asset("images/default.jpg") alt="Image du header par défaut" decoding="async" loading="lazy"/>
            @endif
            @if($asset)
                <img class="asset" src=@asset('images/imgTest.jpg') alt="Image de décoration" decoding="async" loading="lazy"/>
            @endif
        </div>
    </section>
@endif