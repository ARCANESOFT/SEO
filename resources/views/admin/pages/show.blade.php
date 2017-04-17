<?php /** @var  \Arcanesoft\Seo\Models\Page  $page */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-files-o"></i> {{ trans('seo::pages.titles.pages') }} <small>{{ trans('seo::pages.titles.page-details') }}</small></h1>
@endsection

@section('content')
    {{-- PAGE DETAILS --}}
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">{{ trans('seo::pages.titles.page-details') }}</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed no-margin">
                            <tr>
                                <th>{{ trans('seo::pages.attributes.name') }} :</th>
                                <td>{{ $page->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::pages.attributes.locale') }} :</th>
                                <td><span class="label label-inverse">{{ $page->locale_name }}</span></td>
                            </tr>
                            <tr>
                                <th>{{ trans('seo::footers.titles.footers') }} :</th>
                                <td>
                                    {{ label_count($page->footers->count()) }}
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.created_at') }} :</th>
                                <td><small>{{ $page->created_at }}</small></td>
                            </tr>
                            <tr>
                                <th>{{ trans('core::generals.updated_at') }} :</th>
                                <td><small>{{ $page->updated_at }}</small></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_UPDATE)
                        {{ ui_link('edit', route('admin::seo.pages.edit', [$page])) }}
                    @endcan

                    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_DELETE)
                        {{ ui_link('delete', '#delete-page-modal', [], ! $page->isDeletable()) }}
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">{{ trans('seo::pages.attributes.content') }}</h2>
                </div>
                <div class="box-body">
                    {!! $page->content_preview !!}
                </div>
            </div>
        </div>
    </div>

    {{-- FOOTERS --}}
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">{{ trans('seo::footers.titles.footers') }}</h2>
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
                        @forelse($page->footers as $footer)
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
                                    @can(\Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_SHOW)
                                        {{ ui_link('show', route('admin::seo.footers.show', [$footer])) }}
                                    @endcan

                                    @can(\Arcanesoft\Seo\Policies\FootersPolicy::PERMISSION_UPDATE)
                                        {{ ui_link('edit', route('admin::seo.footers.edit', [$footer])) }}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span class="label label-default">{{ trans('seo::pages.has-no-footers') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    {{-- DELETE MODAL --}}
    <div id="delete-page-modal" class="modal fade">
        <div class="modal-dialog">
            {{ Form::open(['route' => ['admin::seo.pages.delete', $page], 'method' => 'DELETE', 'id' => 'delete-page-form', 'class' => 'form form-loading']) }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{ trans('seo::pages.modals.delete.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>{!! trans('seo::pages.modals.delete.message', ['name' => $page->name]) !!}</p>
                    </div>
                    <div class="modal-footer">
                        {{ ui_button('cancel')->appendClass('pull-left')->setAttribute('data-dismiss', 'modal') }}
                        {{ ui_button('delete', 'submit')->withLoadingText() }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    {{-- DELETE SCRIPT --}}
    @can(\Arcanesoft\Seo\Policies\PagesPolicy::PERMISSION_DELETE)
    <script>
        $(function () {
            var $deletePageModal = $('div#delete-page-modal'),
                $deletePageForm  = $('form#delete-page-form');

            $('a[href="#delete-page-modal"]').on('click', function (e) {
                e.preventDefault();

                $deletePageModal.modal('show');
            });

            $deletePageForm.on('submit', function (e) {
                e.preventDefault();

                var submitBtn = $deletePageForm.find('button[type="submit"]');
                    submitBtn.button('loading');

                axios.delete($deletePageForm.attr('action'))
                    .then(function (response) {
                        if (response.data.status === 'success') {
                            $deletePageModal.modal('hide');
                            location.replace("{{ route('admin::seo.pages.index') }}");
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
