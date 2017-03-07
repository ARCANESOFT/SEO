@section('header')
    <h1>SEO <small>Pages</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Pages</h2>
            <div class="box-tools">
                <a href="{{ route('admin::seo.pages.create') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-original-title="Add">
                    <i class="fa fa-fw fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th style="width: 65px;">Locale</th>
                            <th>Name</th>
                            <th class="text-center" style="width: 85px;">Nb. Footers</th>
                            <th class="text-right" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pages->count())
                            @foreach ($pages as $page)
                            <tr>
                                <td>
                                    <span class="label label-inverse">{{ strtoupper($page->locale) }}</span>
                                </td>
                                <td>
                                    {{ $page->name }}
                                </td>
                                <td class="text-center">
                                    <span class="label label-{{ $page->footers->count() ? 'info' : 'default' }}">
                                        {{ $page->footers->count() }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin::seo.pages.show', [$page]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                        <i class="fa fa-fw fa-search"></i>
                                    </a>
                                    <a href="{{ route('admin::seo.pages.edit', [$page]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-fw fa-pencil"></i>
                                    </a>
                                    <a href="#deletePageModal" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">The pages list is empty!</span>
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
