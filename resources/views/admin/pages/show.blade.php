@section('header')
    <h1>SEO <small>Page Details</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Page Details</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>Name :</th>
                                <td>{{ $page->name }}</td>
                            </tr>
                            <tr>
                                <th>Locale :</th>
                                <td><span class="label label-inverse">{{ $page->locale_name }}</span></td>
                            </tr>
                            <tr>
                                <th>Nb. Footers :</th>
                                <td>
                            <span class="label label-{{ $page->footers->count() ? 'info' : 'default' }}">
                                {{ $page->footers->count() }}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created at :</th>
                                <td><small>{{ $page->created_at }}</small></td>
                            </tr>
                            <tr>
                                <th>Updated at :</th>
                                <td><small>{{ $page->updated_at }}</small></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('admin::seo.pages.edit', [$page]) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-fw fa-pencil"></i> Edit
                    </a>
                    <a href="#deletePageModal" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Content</h2>
                </div>
                <div class="box-body">
                    {!! $page->content_preview !!}
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Footers</h2>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-condensed no-margin">
                    @if ($page->footers->count())
                        @foreach($page->footers as $footer)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">
                                <span class="label label-default">The footers list is empty!</span>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
