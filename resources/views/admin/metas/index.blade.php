<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $metas */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-tags"></i> {{ trans('seo::metas.titles.metas') }} <small>{{ trans('seo::metas.titles.metas-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('core::admin._includes.pagination.labels', ['paginator' => $metas])
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>{{ trans('seo::metas.attributes.type') }}</th>
                            <th>{{ trans('seo::metas.attributes.title') }}</th>
                            <th>{{ trans('seo::metas.attributes.description') }}</th>
                            <th class="text-right">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($metas as $meta)
                            <tr>
                                <td>
                                    <span class="label label-default">{{ $meta->seoable_type }}</span>
                                </td>
                                <td>{{ $meta->title }}</td>
                                <td>{{ str_limit($meta->description, 100, '&hellip;') }}</td>
                                <td class="text-right">
                                    {{ ui_link_icon('show', route('admin::seo.metas.show', [$meta])) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">{{ trans('seo::metas.list-empty') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($metas->hasPages())
            <div class="box-footer clearfix">{!! $metas->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
