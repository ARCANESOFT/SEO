@section('header')
    <h1>SEO <small>Footers</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('seo::admin._includes.pagination-labels', ['paginator' => $footers])
            <div class="box-tools">
                <a href="{{ route('admin::seo.footers.create') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" data-original-title="Add">
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
                            <th>Localization</th>
                            <th>URI</th>
                            <th style="width: 100px;" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($footers->count())
                            @foreach ($footers as $footer)
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
                                    <a href="#deleteFooterModal" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete" data-footer-id="{{ $footer->id }}">
                                        <i class="fa fa-fw fa-trash-o"></i>
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
        @include('seo::admin._includes.pagination-navs', ['paginator' => $footers])
    </div>
@endsection

@section('modals')
    <div id="deleteFooterModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.footers.delete', ':id'], 'method' => 'DELETE', 'id' => 'deleteFooterForm', 'class' => 'form form-loading']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Footer</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <span class="label label-danger">delete</span> this footer ?</p>
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
            var $deleteFooterModal = $('div#deleteFooterModal'),
                $deleteFooterForm  = $('form#deleteFooterForm'),
                deleteFooterAction = $deleteFooterForm.attr('action');

            $('a[href="#deleteFooterModal"]').on('click', function (e) {
                e.preventDefault();

                $deleteFooterForm.attr('action', deleteFooterAction.replace(':id', $(this).data('footer-id')));

                $deleteFooterModal.modal('show');
            });

            $deleteFooterModal.on('hidden.bs.modal', function () {
                $deleteFooterForm.attr('action', deleteFooterAction);
            });

            $deleteFooterForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deleteFooterForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                $.ajax({
                    url:      $deleteFooterForm.attr('action'),
                    type:     $deleteFooterForm.attr('method'),
                    dataType: 'json',
                    data:     $deleteFooterForm.serialize(),
                    success: function (data, textStatus, xhr) {
                        if (data.status == 'success') {
                            $deleteFooterModal.modal('hide');
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
