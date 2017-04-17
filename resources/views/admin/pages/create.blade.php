@section('header')
    <h1><i class="fa fa-fw fa-files-o"></i> {{ trans('seo::pages.titles.pages') }} <small>{{ trans('seo::pages.titles.create-page') }}</small></h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin::seo.pages.store', 'method' => 'POST', 'class' => 'form form-loading']) }}
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">{{ trans('seo::pages.titles.new-page') }}</h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                            {{ Form::label('name', trans('seo::pages.attributes.name').' :') }}
                            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                            @if ($errors->has('name'))
                                <span class="text-red">{!! $errors->first('name') !!}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->first('locale', 'has-error') }}">
                            {{ Form::label('locale', trans('seo::pages.attributes.locale').' :') }}
                            {{ Form::select('locale', $locales, old('locale', config('app.locale')), ['class' => 'select-2-fw']) }}
                            @if ($errors->has('locale'))
                                <span class="text-red">{!! $errors->first('locale') !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="clearfix visible-md visible-lg"></div>

                    <div class="col-md-12">
                        <div class="form-group {{ $errors->first('content', 'has-error') }}">
                            {{ Form::label('content', trans('seo::pages.attributes.content').' :') }}
                            {{ Form::textarea('content', old('content'), ['class' => 'form-control']) }}
                            @if ($errors->has('content'))
                                <span class="text-red">{!! $errors->first('content') !!}</span>
                            @endif
                        </div>

                        <code>{{ trans('seo::pages.attributes.shortcodes') }} : {{ \Arcanesoft\Seo\Models\Page::getContentReplacer()->getShortcodesKeys()->implode(', ') }}</code>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {{ ui_link('cancel', route('admin::seo.pages.index')) }}
                {{ ui_button('add', 'submit')->appendClass('pull-right') }}
            </div>
        </div>
    {{ Form::close() }}
@endsection

@section('modals')
@endsection

@section('scripts')
    <script>
        $(function () {
            new SimpleMDE({
                element: $('textarea#content')[0],
                spellChecker: false
            });
        });
    </script>
@endsection
