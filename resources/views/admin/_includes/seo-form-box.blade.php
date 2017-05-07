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
                    {{ Form::label('seo_title', trans('seo::metas.attributes.title').' :') }}
                    <seo-length-counter name="seo_title" value="{{ old('seo_title', $model['title']) }}"></seo-length-counter>
                    @if ($errors->has('seo_title'))
                        <span class="text-red">{!! $errors->first('seo_title') !!}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group {{ $errors->first('seo_description', 'has-error') }}">
                    {{ Form::label('seo_description', trans('seo::metas.attributes.description').' :') }}
                    <seo-length-counter name="seo_description" value="{{ old('seo_description', $model['description']) }}" :min="150" :max="160"></seo-length-counter>
                    @if ($errors->has('seo_description'))
                        <span class="text-red">{!! $errors->first('seo_description') !!}</span>
                    @endif
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group {{ $errors->first('seo_keywords', 'has-error') }}">
                    {{ Form::label('seo_keywords[]', trans('seo::metas.attributes.keywords').' :') }}
                    <seo-keyword-tags name="seo_keywords[]" :selected="{{ json_encode(old('seo_keywords', $model['keywords'])) }}"></seo-keyword-tags>
                    @if ($errors->has('seo_keywords'))
                        <span class="text-red">{!! $errors->first('seo_keywords') !!}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
