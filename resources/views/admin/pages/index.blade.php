@section('header')
    <h1>SEO <small>Pages</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('seo::admin._includes.pagination-labels', ['paginator' => $pages])
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
                                    @if ($page->isDeletable())
                                    <a href="#deletePageModal" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete" data-page-id="{{ $page->id }}">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </a>
                                    @else
                                    <button class="btn btn-xs btn-default" data-toggle="tooltip" data-original-title="Delete" disabled>
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </button>
                                    @endif
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
        @include('seo::admin._includes.pagination-navs', ['paginator' => $pages])
    </div>
@endsection

@section('modals')
    <div id="deletePageModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.pages.delete', ':id'], 'method' => 'DELETE', 'id' => 'deletePageForm', 'class' => 'form form-loading']) }}
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
                $deletePageForm  = $('form#deletePageForm'),
                deletePageAction = $deletePageForm.attr('action');

            $('a[href="#deletePageModal"]').on('click', function (e) {
                e.preventDefault();

                $deletePageForm.attr('action', deletePageAction.replace(':id', $(this).data('page-id')));

                $deletePageModal.modal('show');
            });

            $deletePageModal.on('hidden.bs.modal', function () {
                $deletePageForm.attr('action', deletePageAction);
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
                            location.reload();
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
