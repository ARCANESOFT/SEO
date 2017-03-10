<div class="row">
    @foreach($seoFooters->chunk(ceil($seoFooters->count() / 2)) as $items)
    <div class="col-sm-6">
        @include('seo::public._composers.widgets.footers._links', ['items' => $items])
    </div>
    @endforeach
</div>

