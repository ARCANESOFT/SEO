<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $redirects */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-random"></i> {{ trans('seo::redirects.titles.redirections') }} <small>{{ trans('seo::redirects.titles.redirections-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('core::admin._includes.pagination.labels', ['paginator' => $redirects])

            @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_CREATE)
            <div class="box-tools">
                {{ ui_link_icon('add', route('admin::seo.redirects.create')) }}
            </div>
            @endcan
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>{{ trans('seo::redirects.attributes.old_url') }}</th>
                            <th>{{ trans('seo::redirects.attributes.new_url') }}</th>
                            <th class="text-center" style="width: 55px;">{{ trans('seo::redirects.attributes.status') }}</th>
                            <th class="text-right" style="width: 100px;">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($redirects as $redirect)
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
                                    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_SHOW)
                                        {{ ui_link_icon('show', route('admin::seo.redirects.show', [$redirect])) }}
                                    @endcan

                                    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_UPDATE)
                                        {{ ui_link_icon('edit', route('admin::seo.redirects.edit', [$redirect])) }}
                                    @endcan

                                    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
                                        {{ ui_link_icon('delete', '#delete-redirect-modal', ['data-redirect-id' => $redirect->id]) }}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">{{ trans('seo::redirects.list-empty') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($redirects->hasPages())
            <div class="box-footer clearfix">{!! $redirects->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
    <div id="delete-redirect-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.redirects.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-redirect-form', 'class' => 'form form-loading']) }}
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
    {{-- DELETE SCRIPT --}}
    @can(Arcanesoft\Seo\Policies\RedirectsPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            var $deleteRedirectModal = $('div#delete-redirect-modal'),
                $deleteRedirectForm  = $('form#delete-redirect-form'),
                deleteRedirectAction = $deleteRedirectForm.attr('action');

            $('a[href="#delete-redirect-modal"]').on('click', function (e) {
                e.preventDefault();

                $deleteRedirectForm.attr('action', deleteRedirectAction.replace(':id', $(this).attr('data-redirect-id')));

                $deleteRedirectModal.modal('show');
            });

            $deleteRedirectModal.on('hidden.bs.modal', function () {
                $deleteRedirectForm.attr('action', deleteRedirectAction);
            });

            $deleteRedirectForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deleteRedirectForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deleteRedirectForm.attr('action'))
                     .then(function (response) {
                         if (response.data.status === 'success') {
                             $deleteRedirectModal.modal('hide');
                             location.reload();
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
