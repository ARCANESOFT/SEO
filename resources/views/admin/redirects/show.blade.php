@section('header')
    <h1>SEO <small>Redirection details</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Redirection details</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <td><b>Old URL :</b></td>
                                <td>
                                    <span class="label label-default">{{ $redirect->old_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>New URL :</b></td>
                                <td>
                                    <span class="label label-primary">{{ $redirect->new_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Status :</b></td>
                                <td>
                            <span class="label label-inverse">
                                {{ $redirect->status_name }}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Created at :</b></td>
                                <td>
                                    <small>{{ $redirect->created_at }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Updated at :</b></td>
                                <td>
                                    <small>{{ $redirect->updated_at }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('admin::seo.redirects.edit', [$redirect]) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-fw fa-pencil"></i> Edit
                    </a>
                    <a href="#deleteRedirectModal" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="deleteRedirectModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.redirects.delete', $redirect], 'method' => 'DELETE', 'id' => 'deleteRedirectForm', 'class' => 'form form-loading']) }}
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
                $deleteRedirectForm  = $('form#deleteRedirectForm');

            $('a[href="#deleteRedirectModal"]').on('click', function (e) {
                e.preventDefault();

                $deleteRedirectModal.modal('show');
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
