@section('header')
    <h1>SEO <small>Metas</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <div class="box-title">Metas</div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Keywords</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($metas->count())
                            @foreach ($metas as $meta)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
