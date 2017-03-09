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
                    @if ($page->isDeletable())
                    <a href="#deletePageModal" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </a>
                    @else
                    <button class="btn btn-sm btn-default" disabled>
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </button>
                    @endif
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
                    <thead>
                        <tr>
                            <th style="width: 65px;">Locale</th>
                            <th>Name</th>
                            <th>Localization</th>
                            <th>URI</th>
                            <th style="width: 100px;" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($page->footers->count())
                            @foreach($page->footers as $footer)
                            <tr>
                                <td>
                                    <span class="label label-inverse">{{ strtoupper($footer->locale) }}</span>
                                </td>
                                <td>
                                    <b>{{ $footer->name }}</b>
                                </td>
                                <td>
                                    <b>{{ $footer->localization }}</b>
                                </td>
                                <td>
                                    <span class="label label-primary">{{ $footer->uri }}</span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin::seo.footers.show', [$footer]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                        <i class="fa fa-fw fa-search"></i>
                                    </a>
                                    <a href="{{ route('admin::seo.footers.edit', [$footer]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-fw fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span class="label label-default">The footers list is empty!</span>
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
    <div id="deletePageModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.pages.delete', $page], 'method' => 'DELETE', 'id' => 'deletePageForm', 'class' => 'form form-loading']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Page</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <span class="label label-danger">delete</span> this page ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var $deletePageModal = $('div#deletePageModal'),
                $deletePageForm  = $('form#deletePageForm');

            $('a[href="#deletePageModal"]').on('click', function (e) {
                e.preventDefault();

                $deletePageModal.modal('show');
            });

            $deletePageForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deletePageForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                $.ajax({
                    url:      $deletePageForm.attr('action'),
                    type:     $deletePageForm.attr('method'),
                    dataType: 'json',
                    data:     $deletePageForm.serialize(),
                    success: function (data, textStatus, xhr) {
                        if (data.status == 'success') {
                            $deletePageModal.modal('hide');
                            location.replace("{{ route('admin::seo.pages.index') }}");
                        }
                        else {
                            alert('AJAX ERROR! Check the console!')
                            console.error(data.message, textStatus, xhr);
                            submitBtn.button('reset');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR! Check the console!')
                        console.error(xhr, textStatus, errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
