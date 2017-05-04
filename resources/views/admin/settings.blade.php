@section('header')
    <h1><i class="fa fa-fw fa-cog"></i> {{ trans('seo::settings.titles.settings') }} <small></small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ trans('seo::settings.url-redirector.title') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-condensed table-hover no-margin">
                        <tr>
                            <th>Enabled :</th>
                            <td class="text-right">
                                <span class="label label-{{ $redirector['enabled'] ? 'success' : 'default' }}">
                                    {{ $redirector['enabled'] ? 'Yes' : 'No' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Driver :</th>
                            <td class="text-right">
                                <span class="label label-primary">{{ $redirector['default'] }}</span>
                            </td>
                        </tr>
                        @if ($redirector['default'] == 'eloquent')
                        <tr>
                            <th>Cache key :</th>
                            <td class="text-right">
                                <span class="label label-inverse">{{ array_get($redirector, 'drivers.eloquent.options.cache.key') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Cache Duration :</th>
                            <td class="text-right">
                            <span class="label label-inverse">
                                {{ array_get($redirector, 'drivers.eloquent.options.cache.duration') }} Minutes
                            </span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
