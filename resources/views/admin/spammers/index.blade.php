@section('header')
    <h1>SEO <small>Spammers</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">Spammers</div>
            <div class="box-tools">
                <span class="label label-info">Total : {{ $spammers->total() }}</span>
                @if ($spammers->hasPages())
                    <span class="label label-info">
                        {{ trans('foundation::pagination.pages', ['current' => $spammers->currentPage(), 'last' => $spammers->lastPage()]) }}
                    </span>
                @endif
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>Host</th>
                            <th class="text-center">Blocked</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($spammers->count())
                        @foreach ($spammers as $spammer)
                        <tr>
                            <td>
                                {{ utf8_decode($spammer->host()) }}
                            </td>
                            <td class="text-center">
                            <span class="label label-{{ $spammer->isBlocked() ? 'success' : 'default' }}">
                                {{ $spammer->isBlocked() ? 'Yes' : 'No' }}
                            </span>
                            </td>
                            <td class="text-right">
                                @if ($spammer->isBlocked())
                                    <a href="#" class="btn btn-xs btn-inverse">
                                        <i class="fa fa-fw fa-ban"></i>
                                    </a>
                                @else
                                    <a href="#" class="btn btn-xs btn-success">
                                        <i class="fa fa-fw fa-check"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="label label-default">The spammers list is empty!</span>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if ($spammers->hasPages())
            <div class="box-footer text-center clearfix">
                {{ $spammers->render() }}
            </div>
        @endif
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
