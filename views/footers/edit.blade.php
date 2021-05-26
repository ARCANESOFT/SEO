@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-link"></i> @lang('Edit Footer')
@endsection

<?php /** @var  Arcanesoft\Seo\Models\Footer  $footer */?>

@section('content')
    <x-arc:form action="{{ route(Arcanesoft\Seo\Http\Routes\FootersRoutes::ROUTE_UPDATE, [$footer]) }}" method="PUT">
        <div class="row g-3">
            {{-- FOOTER --}}
            <div class="col-lg-6">
                <x-arc:card>
                    <x-arc:card-header>@lang('Footer')</x-arc:card-header>
                    <x-arc:card-body>
                        <div class="row g-3">
                            {{-- NAME --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="text" name="name" :value="old('name', $footer->name)" label="Name" required/>
                            </div>
                            {{-- URL --}}
                            <div class="col-12">
                                <x-arc:input-control
                                    type="text" name="url" :value="old('url', $footer->url)" label="URL"/>
                            </div>
                        </div>
                    </x-arc:card-body>
                    <x-arc:card-footer class="d-flex justify-content-between">
                        <x-arc:form-cancel-button to="{{ route(Arcanesoft\Seo\Http\Routes\FootersRoutes::ROUTE_SHOW, [$footer]) }}"/>
                        <x-arc:form-submit-button type="save"/>
                    </x-arc:card-footer>
                </x-arc:card>
            </div>
            {{-- PAGE --}}
            <div class="col-lg-6">
                <x-arc:card>
                    <x-arc:card-header>@lang('Page')</x-arc:card-header>
                    <x-arc:card-body>
                        <v-seo-footer-placeholders
                            :page="{{ request('page', $footer->page->getKey()) }}" :pages='@json($pages)'
                            :value='@json(old("placeholders", $footer->placeholders))'/>
                    </x-arc:card-body>
                </x-arc:card>
            </div>
            {{-- METAS --}}
            <div class="col-12">
                <v-seo-metas
                    :value='@json(old("metas", $footer->meta->tags))'/>
            </div>
        </div>
    </x-arc:form>
@endsection

@push('scripts')
@endpush
