<?php /** @var  \Illuminate\Pagination\LengthAwarePaginator  $spammers */ ?>

@section('header')
    <h1><i class="fa fa-fw fa-ban"></i> {{ trans('seo::spammers.titles.spammers') }} <small>{{ trans('seo::spammers.titles.spammers-list') }}</small></h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @include('core::admin._includes.pagination.labels', ['paginator' => $spammers])
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive">
                <table class="table table-condensed table-hover no-margin">
                    <thead>
                        <tr>
                            <th>{{ trans('seo::spammers.attributes.host') }}</th>
                            <th class="text-center">{{ trans('seo::spammers.attributes.blocked') }}</th>
                            <th class="text-right">{{ trans('core::generals.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spammers as $spammer)
                            <?php /** @var  \Arcanedev\SpamBlocker\Entities\Spammer  $spammer */ ?>
                            <tr>
                                <td>
                                    {{ utf8_decode($spammer->host()) }}
                                </td>
                                <td class="text-center">
                                    <span class="label label-{{ $spammer->isBlocked() ? 'success' : 'default' }}">
                                        {{ $spammer->isBlocked() ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    {{ ui_link_icon($spammer->isBlocked() ? 'disable' : 'enable', '#activate-spammer-modal', ['data-current-statue' => $spammer->isBlocked() ? 'enabled' : 'disabled', 'data-spammer-host' => $spammer->host()]) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="label label-default">{{ trans('seo::spammers.list-empty') }}</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($spammers->hasPages())
            <div class="box-footer clearfix">{!! $spammers->render() !!}</div>
        @endif
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
