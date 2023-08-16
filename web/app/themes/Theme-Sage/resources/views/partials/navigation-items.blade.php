<div id="partialsNavigation-items">
    <h3>{!! $titre !!}</h3>
    <ul class="items">
        @foreach($items as $item)
            <li class="item {!! $item['id'] !!}">
                <a href="{!! $item['url'] !!}">{!! $item["titre"] !!}</a>
            </li>
        @endforeach
    </ul>
</div>