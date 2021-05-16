@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('Metas')
@endsection

@push('content-nav')
    <nav class="page-actions">
        <a href="{{ route(Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_METRICS) }}"
           class="btn btn-sm btn-secondary {{ active([Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_METRICS]) }}">@lang('Metrics')</a>

        <a href="{{ route(Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_INDEX) }}"
           class="btn btn-sm btn-secondary {{ active([Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_INDEX]) }}">@lang('List')</a>
    </nav>
@endpush

@section('content')
    <v-datatable url="{{ route(Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_DATATABLE) }}"
                 name="metas-datatable"/>
@endsection
