@include('sections.navigation')
@include('sections.header')
<main id="layoutPage" class="page_{!! $id !!}">
    {!! $content !!}
    @include('sections.list-articles')
    @include('sections.contact')
</main>
@include('sections.footer')