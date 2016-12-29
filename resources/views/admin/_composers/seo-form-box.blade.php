<?php
$model    = isset($model) ? $model : ['title' => '', 'description' => '', 'keywords' => [], 'metas' => collect()];
$seoMetas = $model['metas'];
?>

<div class="box">
    <div class="box-header with-border">
        <h2 class="box-title">SEO</h2>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group {{ $errors->first('seo_description', 'has-error') }}">
                    {{ Form::label('seo_title', 'Title :') }}
                    {{ Form::text('seo_title', old('seo_title', $model['title']), ['class' => 'form-control', 'rows' => 1, 'style' => 'resize: none;']) }}
                    @if ($errors->has('seo_title'))
                        <span class="text-red">{!! $errors->first('seo_title') !!}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group {{ $errors->first('seo_description', 'has-error') }}">
                    {{ Form::label('seo_description', 'Description :') }}
                    {{ Form::textarea('seo_description', old('seo_description', $model['description']), ['class' => 'form-control', 'rows' => 1, 'style' => 'resize: none;']) }}
                    @if ($errors->has('seo_description'))
                        <span class="text-red">{!! $errors->first('seo_description') !!}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group {{ $errors->first('seo_keywords', 'has-error') }}">
                    {{ Form::label('seo_keywords[]', 'Keywords :') }}
                    {{ Form::select('seo_keywords[]', [], old('seo_keywords', $model['keywords']), ['class' => 'form-control', 'multiple' => 'multiple', 'data-placeholder' => 'Add keywords', 'style' => 'width: 100%;']) }}
                    @if ($errors->has('seo_keywords'))
                        <span class="text-red">{!! $errors->first('seo_keywords') !!}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script>
        $(function () {
            $('select[name="seo_keywords[]"]').select2({
                tags: true,
                createTag: function (params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                }
            });
        })
    </script>
@endsection
