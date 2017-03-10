@extends('_templates.default.master')

@section('page-title')
    {{ $footer->seo->title }}
@endsection

@section('content')
    <div class="container">
        {!! $footer->content !!}
    </div>
@endsection
