@section('header')
    <h1><i class="fa fa-fw fa-tags"></i> {{ trans('seo::metas.titles.metas') }} <small>{{ trans('seo::metas.titles.metas-details') }}</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            {{-- METAS DETAILS --}}
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ trans('seo::metas.titles.metas-details') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <th>{{ trans('seo::metas.attributes.title') }}</th>
                                <td>{{ $meta->title }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::metas.attributes.description') }}</th>
                                <td>{{ $meta->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::metas.attributes.keywords') }}</th>
                                <td>{{ $meta->keywords->implode(', ') }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::metas.attributes.no-index') }}</th>
                                <td>
                                    {{ label_active_status($meta->noindex) }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.created_at') }}</th>
                                <td>
                                    <small>{{ $meta->created_at }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.created_at') }}</th>
                                <td>
                                    <small>{{ $meta->updated_at }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {{-- META Scores --}}
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">SEO Scores</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <th>{{ trans('seo::metas.attributes.title') }}</th>
                                <td class="text-right">
                                    <span class="label label-{{ $meta->title_status }}">
                                        {{ $meta->title_length }} chars
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::metas.attributes.description') }}</th>
                                <td class="text-right">
                                    <span class="label label-{{ $meta->description_status }}">
                                        {{ trans('seo::metas.scores.chars', ['count' => $meta->description_length]) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::metas.attributes.keywords') }}</th>
                                <td class="text-right">
                                    <span class="label label-default">
                                        {{ trans('seo::metas.scores.words', ['count' => $meta->keywords->count()]) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- SEOABLE --}}
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ trans('seo::metas.titles.seo-entity') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <th>{{ trans('seo::metas.attributes.type') }}</th>
                                <td class="text-right">
                                    <span class="label label-default">{{ $meta->seoable_type }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    {{ ui_link('show', $meta->seoable->getShowUrl()) }}
                    {{ ui_link('edit', $meta->seoable->getEditUrl()) }}
                </div>
            </div>
        </div>
    </div>
@endsection
