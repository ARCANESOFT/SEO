@section('header')
    <h1>SEO <small>New Footer</small></h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin::seo.footers.store', 'method' => 'POST', 'class' => 'form form-loading']) }}
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">New Footer</h2>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->first('name', 'has-error') }}">
                        {{ Form::label('name', 'Name :') }}
                        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                        @if ($errors->has('name'))
                            <span class="text-red">{!! $errors->first('name') !!}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->first('localization', 'has-error') }}">
                        {{ Form::label('localization', 'Localization :') }}
                        {{ Form::text('localization', old('localization'), ['class' => 'form-control']) }}
                        @if ($errors->has('localization'))
                            <span class="text-red">{!! $errors->first('localization') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="clearfix visible-md visible-lg"></div>

                <div class="col-md-6">
                    <div class="form-group {{ $errors->first('uri', 'has-error') }}">
                        {{ Form::label('uri', 'URI :') }}
                        {{ Form::text('uri', old('uri'), ['class' => 'form-control']) }}
                        @if ($errors->has('uri'))
                            <span class="text-red">{!! $errors->first('uri') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="cleafix visible-sm"></div>

                <div class="col-sm-6 col-md-3">
                    <div class="form-group {{ $errors->first('locale', 'has-error') }}">
                        {{ Form::label('locale', 'Locale :') }}
                        {{ Form::select('locale', $locales, old('locale', config('app.locale')), ['class' => 'select-2-fw']) }}
                        @if ($errors->has('locale'))
                            <span class="text-red">{!! $errors->first('locale') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="form-group {{ $errors->first('page', 'has-error') }}">
                        {{ Form::label('page', 'Page :') }}
                        {{ Form::select('page', $pages, old('page', 0), ['class' => 'select-2-fw']) }}
                        @if ($errors->has('page'))
                            <span class="text-red">{!! $errors->first('page') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="clearfix visible-sm visible-md visible-lg"></div>

                <div class="col-md-12">
                    <div class="form-group {{ $errors->first('seo_title', 'has-error') }}">
                        {{ Form::label('seo_title', 'SEO Title :') }}
                        {{ Form::text('seo_title', old('seo_title'), ['class' => 'form-control']) }}
                        @if ($errors->has('seo_title'))
                            <span class="text-red">{!! $errors->first('seo_title') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group {{ $errors->first('seo_description', 'has-error') }}">
                        {{ Form::label('seo_description', 'SEO Description :') }}
                        {{ Form::text('seo_description', old('seo_description'), ['class' => 'form-control']) }}
                        @if ($errors->has('seo_description'))
                            <span class="text-red">{!! $errors->first('seo_description') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group {{ $errors->first('seo_keywords', 'has-error') }}">
                        {{ Form::label('seo_keywords[]', 'SEO Keywords :') }}
                        {{ Form::select('seo_keywords[]', [], old('seo_keywords[]'), ['class' => 'form-control', 'multiple']) }}
                        @if ($errors->has('seo_keywords'))
                            <span class="text-red">{!! $errors->first('seo_keywords') !!}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ route('admin::seo.footers.index') }}" class="btn btn-sm btn-default">
                Cancel
            </a>
            <button type="submit" class="btn btn-sm btn-primary pull-right">
                <i class="fa fa-fw fa-plus"></i> Add
            </button>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('modals')
@endsection

@section('scripts')
    <script>
        $(function () {
            $('select[name="seo_keywords[]"]').select2({
                tags: true
            });
        });
    </script>
@endsection
