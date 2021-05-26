@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-newspaper"></i> @lang('Pages') <small>@lang("Page's details")</small>
@endsection

<?php /** @var  Arcanesoft\Seo\Models\Page|mixed  $page */ ?>

@section('content')
    <div class="row g-4">
        {{-- PAGE --}}
        <div class="col-lg-4">
            <x-arc:card>
                <x-arc:card-header>@lang('Page')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Name"/>
                            <td class="text-end small">{{ $page->name }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Language"/>
                            <td class="text-end small">{{ $page->lang }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Footers"/>
                            <td class="text-end">
                                <x-arc:badge-count value="{{ $page->footers->count() }}"/>
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Created at"/>
                            <td class="text-muted text-end small">{{ $page->created_at }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Updated at"/>
                            <td class="text-muted text-end small">{{ $page->updated_at }}</td>
                        </tr>
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Seo\Policies\PagesPolicy::ability('update'), [$page])
                        <a href="{{ route('admin::seo.pages.edit', [$page]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Seo\Policies\PagesPolicy::ability('delete'), [$page])
                        <button class="btn btn-sm btn-danger ms-2"
                                onclick="ARCANESOFT.emit('seo::pages.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>

        {{-- PAGE CONTENT --}}
        <div class="col-lg-8">
            <x-arc:card>
                <x-arc:card-header>@lang('Content')</x-arc:card-header>
                <x-arc:card-body>
                    <div>{{ $page->content_html }}</div>
                </x-arc:card-body>

                @if($page->hasContentPlaceholders())
                <x-arc:card-footer>
                    @foreach($page->content_placeholders as $placeholder)
                        <span class="badge rounded-pill text-muted border border-muted me-1">{{ $placeholder }}</span>
                    @endforeach
                </x-arc:card-footer>
                @endif
            </x-arc:card>
        </div>

        {{-- Footers --}}
        <div class="col-12">
            <x-arc:card>
                <x-arc:card-header>@lang('Footers')</x-arc:card-header>
                <x-arc:card-table>
                    <thead>
                        <x-arc:table-th label="Name"/>
                        <x-arc:table-th label="Actions" class="text-end"/>
                    </thead>
                    <tbody>
                    @forelse($page->footers as $footer)
                        <tr>
                            <td class="small">{{ $footer->name }}</td>
                            <td class="text-end">
                                <a href="{{ route(Arcanesoft\Seo\Http\Routes\FootersRoutes::ROUTE_SHOW, [$footer]) }}"
                                   title="@lang('Show')" data-bs-toggle="tooltip" class="btn btn-sm btn-light">
                                    <i class="far fa-fw fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">No footers are found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    <a href="{{ route('admin::seo.footers.create', ['page' => $page]) }}"
                       class="btn btn-sm btn-primary">@lang('Add')</a>
                </x-arc:card-footer>
            </x-arc:card>
        </div>
    </div>
@endsection
