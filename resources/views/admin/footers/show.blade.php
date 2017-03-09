@section('header')
    <h1>SEO <small>Footer Details</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Footer Details</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>Name :</th>
                                <td>{{ $footer->name }}</td>
                            </tr>
                            <tr>
                                <th>Localization :</th>
                                <td>{{ $footer->localization }}</td>
                            </tr>
                            <tr>
                                <th>URI :</th>
                                <td>
                                    <span class="label label-primary">{{ $footer->uri }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Locale :</th>
                                <td><span class="label label-inverse">{{ $footer->locale_name }}</span></td>
                            </tr>
                            <tr>
                                <th>Page :</th>
                                <td>{{ $footer->page->name }}</td>
                            </tr>
                            <tr>
                                <th>Created at :</th>
                                <td><small>{{ $footer->created_at }}</small></td>
                            </tr>
                            <tr>
                                <th>Updated at :</th>
                                <td><small>{{ $footer->updated_at }}</small></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ route('admin::seo.footers.edit', [$footer]) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-fw fa-pencil"></i> Edit
                    </a>
                    <a href="#deleteFooterModal" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            {{-- CONTENT --}}
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Content</h2>
                </div>
                <div class="box-body">
                    {!! $footer->content !!}
                </div>
            </div>

            {{-- SEO --}}
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">SEO</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>Title</th>
                                <td>{{ $footer->seo->title }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $footer->seo->description }}</td>
                            </tr>
                            <tr>
                                <th>Keywords</th>
                                <td>
                                    @if ($footer->seo->keywords->isEmpty())
                                        <span class="label label-default">null</span>
                                    @else
                                        {{ $footer->seo->keywords_string }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="deleteFooterModal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.footers.delete', $footer], 'method' => 'DELETE', 'id' => 'deleteFooterForm', 'class' => 'form form-loading']) }}
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
                $deleteFooterForm  = $('form#deleteFooterForm');

            $('a[href="#deleteFooterModal"]').on('click', function (e) {
                e.preventDefault();

                $deleteFooterModal.modal('show');
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
                            location.replace("{{ route('admin::seo.footers.index') }}");
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
