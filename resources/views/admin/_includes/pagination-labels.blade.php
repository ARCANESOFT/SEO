<span class="label label-info" style="margin-right: 5px;">
    Total : {{ $paginator->total() }}
</span>
@if ($paginator->hasPages())
    <span class="label label-info">
        {{ trans('foundation::pagination.pages', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }}
    </span>
@endif
