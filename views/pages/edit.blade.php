@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('Edit Page')
@endsection

<?php /** @var  Arcanesoft\Seo\Models\Page  $page */ ?>

@section('content')
    <x-arc:form action="{{ route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_UPDATE, [$page]) }}" method="PUT">
        <x-arc:card>
            <x-arc:card-header>@lang('Page')</x-arc:card-header>
            <x-arc:card-body>
                <div class="row g-3">
                    {{-- NAME --}}
                    <div class="col-12 col-lg-6">
                        <x-arc:input-control
                            type="text" name="name" :value="old('name', $page->name)" label="Name" required/>
                    </div>

                    {{-- LANG --}}
                    <div class="col-12 col-lg-6">
                        <x-arc:select-control
                            name="lang" :value="old('lang', $page->lang)" label="Language" :options="['en' => 'English', 'fr' => 'Français']" required/>
                    </div>

                    {{-- CONTENT --}}
                    <div class="col-12">
                        <x-arc:vue-control
                            component="v-markdown-editor" name="content" id="content" :value="old('content', $page->content)" label="Content"/>
                    </div>
                </div>
            </x-arc:card-body>
            <x-arc:card-footer class="d-flex justify-content-between">
                <x-arc:form-cancel-button to="{{ route(Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_SHOW, [$page]) }}"/>
                <x-arc:form-submit-button type="save"/>
            </x-arc:card-footer>
        </x-arc:card>
    </x-arc:form>
@endsection

@push('scripts')
@endpush
