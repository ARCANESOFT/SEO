@section('header')
    <h1><i class="fa fa-fw fa-th"></i> {{ trans('seo::footers.titles.footers') }} <small>{{ trans('seo::footers.titles.footer-details') }}</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            {{-- FOOTER DETAILS --}}
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">{{ trans('seo::footers.titles.footer-details') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>{{ trans('seo::footers.attributes.name') }} :</th>
                                <td>{{ $footer->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::footers.attributes.localization') }} :</th>
                                <td>{{ $footer->localization }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::footers.attributes.uri') }} :</th>
                                <td>
                                    <span class="label label-primary">{{ $footer->uri }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::footers.attributes.locale') }} :</th>
                                <td><span class="label label-inverse">{{ $footer->locale_name }}</span></td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::footers.attributes.page') }} :</th>
                                <td>{{ $footer->page->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.created_at') }} :</th>
                                <td><small>{{ $footer->created_at }}</small></td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.updated_at') }} :</th>
                                <td><small>{{ $footer->updated_at }}</small></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_UPDATE)
                        {{ ui_link('edit', route('admin::seo.footers.edit', [$footer])) }}
                    @endcan

                    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_DELETE)
                        {{ ui_link('delete', '#delete-footer-modal') }}
                    @endcan
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
        </div>
    </div>

    {{-- SEO METAS --}}
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">{{ trans('seo::metas.titles.seo-metas') }}</h2>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed no-margin">
                    <tr>
                        <th>{{ trans('seo::metas.attributes.title') }} :</th>
                        <td>{{ $footer->seo->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('seo::metas.attributes.description') }} :</th>
                        <td>{{ $footer->seo->description }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('seo::metas.attributes.keywords') }} :</th>
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
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_DELETE)
    <div id="delete-footer-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.footers.delete', $footer], 'method' => 'DELETE', 'id' => 'delete-footer-form', 'class' => 'form form-loading']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{ trans('seo::footers.modals.delete.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('seo::footers.modals.delete.message', ['name' => $footer->name]) }}</p>
                    </div>
                    <div class="modal-footer">
                        {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                        {{ ui_button('delete')->withLoadingText() }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    @endcan
@endsection

@section('scripts')
    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            var $deleteFooterModal = $('div#delete-footer-modal'),
                $deleteFooterForm  = $('form#delete-footer-form');

            $('a[href="#delete-footer-modal"]').on('click', function (e) {
                e.preventDefault();

                $deleteFooterModal.modal('show');
            });

            $deleteFooterForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deleteFooterForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deleteFooterForm.attr('action'))
                     .then(function (response) {
                         if (response.data.status === 'success') {
                             $deleteFooterModal.modal('hide');
                             location.replace("{{ route('admin::seo.footers.index') }}");
                         }
                         else {
                             alert('AJAX ERROR! Check the console!');
                             console.error(response.data.message);
                             submitBtn.button('reset');
                         }
                     })
                     .catch(function (error) {
                         alert('AJAX ERROR! Check the console!');
                         console.log(error);
                         submitBtn.button('reset');
                     });

                return false;
            });
        });
    </script>
    @endcan
@endsection
