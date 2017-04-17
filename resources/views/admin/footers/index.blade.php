<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $footers */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-th"></i> {{ trans('seo::footers.titles.footers') }} <small>{{ trans('seo::footers.titles.footers-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('core::admin._includes.pagination.labels', ['paginator' => $footers])

            @can(\Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_CREATE)
                <div class="box-tools">
                    {{ ui_link_icon('add', route('admin::seo.footers.create')) }}
                </div>
            @endcan
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th style="width: 65px;">{{ trans('seo::footers.attributes.locale') }}</th>
                            <th>{{ trans('seo::footers.attributes.name') }}</th>
                            <th>{{ trans('seo::footers.attributes.localization') }}</th>
                            <th>{{ trans('seo::footers.attributes.uri') }}</th>
                            <th style="width: 100px;" class="text-right">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($footers as $footer)
                            <?php /** @var  \Arcanesoft\Seo\Models\Footer  $footer */ ?>
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
                                    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_SHOW)
                                        {{ ui_link_icon('show', route('admin::seo.footers.show', [$footer])) }}
                                    @endcan

                                    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_UPDATE)
                                        {{ ui_link_icon('edit', route('admin::seo.footers.edit', [$footer])) }}
                                    @endcan

                                    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_DELETE)
                                        {{ ui_link_icon('delete', '#delete-footer-modal', ['data-footer-id' => $footer->id, 'data-footer-name' => $footer->name]) }}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span class="label label-default">{{ trans('seo::footers.list-empty') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($footers->hasPages())
            <div class="box-footer clearfix">{!! $footers->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
    @can(Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_DELETE)
    <div id="delete-footer-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.footers.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-footer-form', 'class' => 'form form-loading']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{ trans('seo::footers.modals.delete.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
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
    <script>
        $(function () {
            var $deleteFooterModal = $('div#delete-footer-modal'),
                $deleteFooterForm  = $('form#delete-footer-form'),
                deleteFooterAction = $deleteFooterForm.attr('action');

            $('a[href="#delete-footer-modal"]').on('click', function (e) {
                e.preventDefault();

                var that = $(this);

                $deleteFooterForm.attr('action', deleteFooterAction.replace(':id', that.attr('data-footer-id')));
                $deleteFooterModal.find('.modal-body p').html(
                    '{!! trans('seo::footers.modals.delete.message') !!}'.replace(':name', that.attr('data-footer-name'))
                );

                $deleteFooterModal.modal('show');
            });

            $deleteFooterModal.on('hidden.bs.modal', function () {
                $deleteFooterForm.attr('action', deleteFooterAction);
            });

            $deleteFooterForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deleteFooterForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deleteFooterForm.attr('action'))
                     .then(function (response) {
                         if (response.data.status === 'success') {
                             $deleteFooterModal.modal('hide');
                             location.reload();
                         }
                         else {
                             alert('AJAX ERROR! Check the console!');
                             console.log(response.data.message);
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
@endsection
