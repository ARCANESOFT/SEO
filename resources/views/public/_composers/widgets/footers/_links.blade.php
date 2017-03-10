<ul class="footer-links-widget">
    @foreach($items as $item)
    <li>
        {{ link_to_route('public::seo.footers.show', $item->name.' '.$item->localization, [$item->uri]) }}
    </li>
    @endforeach
</ul>
