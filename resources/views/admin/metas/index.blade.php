<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $metas */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-tags"></i> {{ trans('seo::metas.titles.metas') }} <small>{{ trans('seo::metas.titles.metas-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('seo::admin._includes.pagination-labels', ['paginator' => $metas])
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                    <tr>
                        <th>Entity</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($metas->count())
                            @foreach ($metas as $meta)
                            <tr>
                                <td>
                                    <span class="label label-default">{{ $meta->seoable_type }}</span>
                                </td>
                                <td>{{ $meta->title }}</td>
                                <td>{{ str_limit($meta->description, 100, '&hellip;') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin::seo.metas.show', [$meta]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                        <i class="fa fa-fw fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">The metas list is empty!</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        @include('seo::admin._includes.pagination-navs', ['paginator' => $metas])
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
