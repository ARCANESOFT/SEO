@section('header')
    <h1>SEO <small>Edit Page</small></h1>
@endsection

@section('content')
    {{ Form::open(['route' => ['admin::seo.pages.update', $page], 'method' => 'PUT', 'class' => 'form form-loading']) }}
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">Edit Page</h2>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group {{ $errors->first('name', 'has-error') }}">
                        {{ Form::label('name', 'Name :') }}
                        {{ Form::text('name', old('name', $page->name), ['class' => 'form-control']) }}
                        @if ($errors->has('name'))
                            <span class="text-red">{!! $errors->first('name') !!}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group {{ $errors->first('locale', 'has-error') }}">
                        {{ Form::label('locale', 'Locale :') }}
                        {{ Form::select('locale', $locales, old('locale', $page->locale), ['class' => 'select-2-fw']) }}
                        @if ($errors->has('locale'))
                            <span class="text-red">{!! $errors->first('locale') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="clearfix visible-md visible-lg"></div>

                <div class="col-md-12">
                    <div class="form-group {{ $errors->first('content', 'has-error') }}">
                        {{ Form::label('content', 'Content :') }}
                        {{ Form::textarea('content', old('content', $page->content), ['class' => 'form-control']) }}
                        @if ($errors->has('content'))
                            <span class="text-red">{!! $errors->first('content') !!}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ route('admin::seo.pages.show', [$page]) }}" class="btn btn-sm btn-default">
                Cancel
            </a>
            <button type="submit" class="btn btn-sm btn-warning pull-right">
                <i class="fa fa-fw fa-pencil"></i> Update
            </button>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
