@section('header')
    <h1>SEO <small>Redirections</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('seo::admin._includes.pagination-labels', ['paginator' => $redirects])
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
                        <th class="text-right" style="width: 100px;">Actions</th>
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
                                    <a href="{{ route('admin::seo.redirects.show', [$redirect]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" data-original-title="Show">
                                        <i class="fa fa-fw fa-search"></i>
                                    </a>
                                    <a href="{{ route('admin::seo.redirects.edit', [$redirect]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-fw fa-pencil"></i>
                                    </a>
                                    <a href="#deleteRedirectModal" class="btn btn-xs btn-danger" data-toggle="tooltip" data-original-title="Delete" data-redirect-id="{{ $redirect->id }}">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </a>
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
        @include('seo::admin._includes.pagination-navs', ['paginator' => $redirects])
    </div>
@endsection

@section('modals')
    <div id="deleteRedirectModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.redirects.delete', ':id'], 'method' => 'DELETE', 'id' => 'deleteRedirectForm', 'class' => 'form form-loading']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Redirection</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <span class="label label-danger">delete</span> this redirection ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger">
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
            // DELETE MODAL
            var $deleteRedirectModal = $('div#deleteRedirectModal'),
                $deleteRedirectForm  = $('form#deleteRedirectForm'),
                deleteRedirectAction = $deleteRedirectForm.attr('action');

            $('a[href="#deleteRedirectModal"]').on('click', function (e) {
                e.preventDefault();

                $deleteRedirectForm.attr('action', deleteRedirectAction.replace(':id', $(this).data('redirect-id')));

                $deleteRedirectModal.modal('show');
            });

            $deleteRedirectModal.on('hidden.bs.modal', function () {
                $deleteRedirectForm.attr('action', deleteRedirectAction);
            });

            $deleteRedirectForm.on('submit', function (e) {
                e.preventDefault();
                var submitBtn = $deleteRedirectForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                $.ajax({
                    url:      $deleteRedirectForm.attr('action'),
                    type:     $deleteRedirectForm.attr('method'),
                    dataType: 'json',
                    data:     $deleteRedirectForm.serialize(),
                    success: function (data, textStatus, xhr) {
                        if (data.status == 'success') {
                            $deleteRedirectModal.modal('hide');
                            location.replace("{{ route('admin::seo.redirects.index') }}");
                        }
                        else {
                            console.error(data.message);
                            alert('AJAX ERROR! Check the console.')
                            submitBtn.button('reset');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.debug(xhr, textStatus, errorThrown);
                        alert('AJAX ERROR! Check the console.')
                        submitBtn.button('reset');
                    }
                });

                return false;
            });
        });
    </script>
@endsection
