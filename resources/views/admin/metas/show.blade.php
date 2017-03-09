@section('header')
    <h1>SEO <small>Meta details</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Meta details</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <th>Title</th>
                                <td>{{ $meta->title }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $meta->description }}</td>
                            </tr>
                            <tr>
                                <th>Keywords</th>
                                <td>{{ $meta->keywords }}</td>
                            </tr>
                            <tr>
                                <th>Noindex</th>
                                <td>
                                    <span class="label label-{{ $meta->noindex ? 'success' : 'default' }}">
                                        {{ $meta->noindex ? 'enabled' : 'disabled' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created at</th>
                                <td>
                                    <small>{{ $meta->created_at }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Updated at</th>
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
                                <th>Title</th>
                                <td class="text-right">
                                    <span class="label label-{{ $meta->title_status }}">
                                        {{ $meta->title_length }} chars
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td class="text-right">
                                    <span class="label label-{{ $meta->description_status }}">
                                        {{ $meta->description_length }} chars
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Keywords</th>
                                <td class="text-right">
                                    <span class="label label-default">{{ $meta->keywords->count() }} words</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- SEOABLE --}}
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">SEO entity</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <th>Type</th>
                                <td class="text-right">
                                    <span class="label label-default">{{ $meta->seoable_type }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ $meta->seoable->getShowUrl() }}" class="btn btn-sm btn-info">
                        <i class="fa fa-fw fa-search"></i> Show
                    </a>
                    <a href="{{ $meta->seoable->getEditUrl() }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-fw fa-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
