<?php /** @var  \Arcanesoft\Seo\Models\Redirect  $redirect */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-random"></i> {{ trans('seo::redirects.titles.redirections') }} <small>{{ trans('seo::redirects.titles.redirection-details') }}</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ trans('seo::redirects.titles.redirection-details') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <td><b>{{ trans('seo::redirects.attributes.old_url') }} :</b></td>
                                <td>
                                    <span class="label label-default">{{ $redirect->old_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('seo::redirects.attributes.new_url') }} :</b></td>
                                <td>
                                    <span class="label label-primary">{{ $redirect->new_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('seo::redirects.attributes.status') }} :</b></td>
                                <td>
                                    <span class="label label-inverse">
                                        {{ $redirect->status_name }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('core::generals.created_at') }} :</b></td>
                                <td>
                                    <small>{{ $redirect->created_at }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{ trans('core::generals.updated_at') }} :</b></td>
                                <td>
                                    <small>{{ $redirect->updated_at }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_UPDATE)
                        {{ ui_link('edit', route('admin::seo.redirects.edit', [$redirect])) }}
                    @endcan

                    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
                        {{ ui_link('delete', '#delete-redirect-modal') }}
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
    <div id="delete-redirect-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.redirects.delete', $redirect], 'method' => 'DELETE', 'id' => 'delete-redirect-form', 'class' => 'form form-loading']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{ trans('seo::redirects.modals.delete.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{!! trans('seo::redirects.modals.delete.message') !!}</p>
                    </div>
                    <div class="modal-footer">
                        {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                        {{ ui_button('delete', 'submit')->withLoadingText() }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    @endcan
@endsection

@section('scripts')
    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            // DELETE MODAL
            var $deleteRedirectModal = $('div#delete-redirect-modal'),
                $deleteRedirectForm  = $('form#delete-redirect-form');

            $('a[href="#delete-redirect-modal"]').on('click', function (e) {
                e.preventDefault();

                $deleteRedirectModal.modal('show');
            });

            $deleteRedirectForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deleteRedirectForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deleteRedirectForm.attr('action'))
                     .then(function (response) {
                         if (response.data.status === 'success') {
                             $deleteRedirectModal.modal('hide');
                             location.replace("{{ route('admin::seo.redirects.index') }}");
                         }
                         else {
                             console.error(response.data.message);
                             alert('AJAX ERROR! Check the console.');
                             submitBtn.button('reset');
                         }
                     })
                     .catch(function (error) {
                         console.log(error);
                         alert('AJAX ERROR! Check the console.');
                         submitBtn.button('reset');
                     });

                return false;
            });
        });
    </script>
    @endcan
@endsection
