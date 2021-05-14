@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('Pages')
@endsection

@push('content-nav')
    <nav class="page-actions">
        <a href="{{ route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_METRICS) }}"
           class="btn btn-sm btn-secondary {{ active([Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_METRICS]) }}">@lang('Metrics')</a>

        <a href="{{ route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_INDEX) }}"
           class="btn btn-sm btn-secondary {{ active([Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_INDEX]) }}">@lang('List')</a>

        {{ arcanesoft\ui\action_link('add', route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_CREATE))->size('sm') }}
    </nav>
@endpush

@section('content')
    <v-datatable url="{{ route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_DATATABLE) }}"
                 name="pages-datatable"/>
@endsection
