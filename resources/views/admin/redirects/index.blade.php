@section('header')
    <h1>SEO <small>Redirections</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Redirections</h2>
            <div class="box-tools">
                <a href="{{ route('admin::seo.redirects.create') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-original-title="Add">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                    <tr>
                        <th>Old URL</th>
                        <th>New URL</th>
                        <th class="text-center" style="width: 55px;">Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($redirects->count())
                            @foreach ($redirects as $redirect)
                            <tr>
                                <td>
                                    <span class="label label-default">{{ $redirect->old_url }}</span>
                                </td>
                                <td>
                                    <span class="label label-primary">{{ $redirect->new_url }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="label label-inverse" data-toggle="tooltip" data-original-title="{{ $redirect->status_name }}">
                                        {{ $redirect->status }}
                                    </span>
                                </td>
                                <td class="text-right">

                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">The redirections list is empty!</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
