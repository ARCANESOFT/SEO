<?php /** @var  \Arcanesoft\Seo\Models\Page  $page */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-files-o"></i> {{ trans('seo::pages.titles.pages') }} <small>{{ trans('seo::pages.titles.edit-page') }}</small></h1>
@endsection

@section('content')
    {{ Form::open(['route' => ['admin::seo.pages.update', $page], 'method' => 'PUT', 'class' => 'form form-loading']) }}
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ trans('seo::pages.titles.update-page') }}</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                            {{ Form::label('name', trans('seo::pages.attributes.name').' :') }}
                            {{ Form::text('name', old('name', $page->name), ['class' => 'form-control']) }}
                            @if ($errors->has('name'))
                                <span class="text-red">{!! $errors->first('name') !!}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->first('locale', 'has-error') }}">
                            {{ Form::label('locale', trans('seo::pages.attributes.locale').' :') }}
                            {{ Form::select('locale', $locales, old('locale', $page->locale), ['class' => 'select-2-fw']) }}
                            @if ($errors->has('locale'))
                                <span class="text-red">{!! $errors->first('locale') !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="clearfix visible-md visible-lg"></div>

                    <div class="col-md-12">
                        <div class="form-group {{ $errors->first('content', 'has-error') }}">
                            {{ Form::label('content', trans('seo::pages.attributes.content').' :') }}
                            {{ Form::textarea('content', old('content', $page->content), ['class' => 'form-control']) }}
                            @if ($errors->has('content'))
                                <span class="text-red">{!! $errors->first('content') !!}</span>
                            @endif
                        </div>

                        <code>{{ trans('seo::pages.attributes.shortcodes') }} : {{ \Arcanesoft\Seo\Models\Page::getContentReplacer()->getShortcodesKeys()->implode(', ') }}</code>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {{ ui_link('cancel', route('admin::seo.pages.show', [$page])) }}
                {{ ui_button('add', 'submit')->appendClass('pull-right') }}
            </div>
        </div>
    {{ Form::close() }}
@endsection

@section('scripts')
    <script>
        $(function () {
            new SimpleMDE({
                element: $('textarea[name="content"]')[0],
                spellChecker: false
            });
        });
    </script>
@endsection
