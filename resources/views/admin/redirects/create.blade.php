@section('header')
    <h1>SEO <small>New Redirection</small></h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin::seo.redirects.store', 'method' => 'POST', 'class' => 'form form-loading']) }}
    <div class="box">
        <div class="box-header with-border">
            <h2 class="box-title">New Redirection</h2>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->first('old_url', 'has-error') }}">
                        {{ Form::label('old_url', 'Old URL:') }}
                        {{ Form::text('old_url', old('old_url'), ['class' => 'form-control', 'required']) }}
                        @if ($errors->has('old_url'))
                            <span class="text-red">{!! $errors->first('old_url') !!}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->first('new_url', 'has-error') }}">
                        {{ Form::label('new_url', 'New URL:') }}
                        {{ Form::text('new_url', old('new_url'), ['class' => 'form-control', 'required']) }}
                        @if ($errors->has('new_url'))
                            <span class="text-red">{!! $errors->first('new_url') !!}</span>
                        @endif
                    </div>
                </div>

                <div class="clearfix visible-md visible-lg"></div>

                <div class="col-md-3">
                    <div class="form-group {{ $errors->first('status', 'has-error') }}">
                        {{ Form::label('status', 'Status code:') }}
                        {{ Form::select('status', $statuses, old('status'), ['class' => 'form-control']) }}
                        @if ($errors->has('status'))
                            <span class="text-red">{!! $errors->first('status') !!}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            {{ link_to_route('admin::seo.redirects.index', 'Cancel', [], ['class' => 'btn btn-sm btn-default']) }}
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
@endsection