@if ($paginator->hasPages())
    <div class="box-footer text-center clearfix">
        {{ $paginator->render() }}
    </div>
@endif
