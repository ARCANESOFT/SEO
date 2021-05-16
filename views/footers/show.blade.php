@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-link"></i> @lang('Footers')
@endsection

<?php /** @var  Arcanesoft\Seo\Models\Footer|mixed  $footer */ ?>

@section('content')
    <div class="row g-3">
        {{-- FOOTER --}}
        <div class="col-lg-4">
            <x-arc:card>
                <x-arc:card-header>@lang('Footer')</x-arc:card-header>
                <x-arc:card-table>
                    <tbody>
                    <tr>
                        <x-arc:table-th label="Name"/>
                        <td class="text-end small">{{ $footer->name }}</td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Language"/>
                        <td class="text-end small">{{ $footer->lang }}</td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Url"/>
                        <td class="text-end small">{{ $footer->url }}</td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Created at"/>
                        <td class="text-muted text-end small">{{ $footer->created_at }}</td>
                    </tr>
                    <tr>
                        <x-arc:table-th label="Updated at"/>
                        <td class="text-muted text-end small">{{ $footer->updated_at }}</td>
                    </tr>
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Seo\Policies\FootersPolicy::ability('update'), [$footer])
                        <a href="{{ route(Arcanesoft\Seo\Http\Routes\FootersRoutes::ROUTE_EDIT, [$footer]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Seo\Policies\FootersPolicy::ability('delete'), [$footer])
                        <button class="btn btn-sm btn-danger ms-2"
                                onclick="ARCANESOFT.emit('seo::footers.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>

        {{-- CONTENT & REPLACERS --}}
        <div class="col-lg-8">
            <div class="row row-cols-1 g-3">
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Content')</x-arc:card-header>
                        <x-arc:card-body>
                            {{ $footer->content_html }}
                        </x-arc:card-body>
                    </x-arc:card>
                </div>
                <div class="col">
                    <x-arc:card>
                        <x-arc:card-header>@lang('Replacers')</x-arc:card-header>
                        <x-arc:card-table>
                            <tbody>
                            @foreach($footer->placeholders as $replacerKey => $replacerValue)
                                <tr>
                                    <td class="small">{{ $replacerKey }}</td>
                                    <td class="text-end small">{{ $replacerValue }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </x-arc:card-table>
                    </x-arc:card>
                </div>
            </div>
        </div>
    </div>
@endsection
