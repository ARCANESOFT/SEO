<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $pages */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-files-o"></i> {{ trans('seo::pages.titles.pages') }} <small>{{ trans('seo::pages.titles.pages-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('core::admin._includes.pagination.labels', ['paginator' => $pages])

            @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_CREATE)
            <div class="box-tools">
                {{ ui_link_icon('add', route('admin::seo.pages.create')) }}
            </div>
            @endcan
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th style="width: 65px;">{{ trans('seo::pages.attributes.locale') }}</th>
                            <th>{{ trans('seo::pages.attributes.name') }}</th>
                            <th class="text-center" style="width: 95px;">{{ trans('seo::footers.titles.footers') }}</th>
                            <th class="text-right" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                            <?php /** @var  \Arcanesoft\Seo\Models\Page  $page */ ?>
                            <tr>
                                <td>
                                    <span class="label label-inverse">{{ strtoupper($page->locale) }}</span>
                                </td>
                                <td>
                                    <b>{{ $page->name }}</b>
                                </td>
                                <td class="text-center">
                                    {{ label_count($page->footers->count()) }}
                                </td>
                                <td class="text-right">
                                    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_SHOW)
                                        {{ ui_link_icon('show', route('admin::seo.pages.show', [$page])) }}
                                    @endcan

                                    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_UPDATE)
                                        {{ ui_link_icon('edit', route('admin::seo.pages.edit', [$page])) }}
                                    @endcan

                                    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_DELETE)
                                        {{ ui_link_icon('delete', '#delete-page-modal', ['data-page-id' => $page->id, 'data-page-name' => $page->name], ! $page->isDeletable()) }}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">{{ trans('seo::pages.list-empty') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($pages->hasPages())
            <div class="box-footer clearfix">{!! $pages->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_DELETE)
    <div id="delete-page-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.pages.delete', ':id'], 'method' => 'DELETE', 'id' => 'delete-page-form', 'class' => 'form form-loading']) }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ trans('seo::pages.modals.delete.title') }}</h4>
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
    {{-- DELETE SCRIPT --}}
    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            var $deletePageModal = $('div#delete-page-modal'),
                $deletePageForm  = $('form#delete-page-form'),
                deletePageAction = $deletePageForm.attr('action');

            $('a[href="#delete-page-modal"]').on('click', function (e) {
                e.preventDefault();

                var that = $(this);

                $deletePageForm.attr('action', deletePageAction.replace(':id', that.attr('data-page-id')));
                $deletePageModal.find('.modal-body p').html(
                    '{!! trans('seo::pages.modals.delete.message') !!}'.replace(':name', that.attr('data-page-name'))
                );

                $deletePageModal.modal('show');
            });

            $deletePageModal.on('hidden.bs.modal', function () {
                $deletePageForm.attr('action', deletePageAction);
            });

            $deletePageForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deletePageForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deletePageForm.attr('action'))
                     .then(function (response) {
                         if (response.data.code === 'success') {
                             $deletePageModal.modal('hide');
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
    @endcan
@endsection
