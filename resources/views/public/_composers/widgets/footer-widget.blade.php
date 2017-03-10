@php($columns = config('arcanesoft.seo.widgets.footers.columns', 1))

@include("seo::public._composers.widgets.footers.{$columns}-col-links")
