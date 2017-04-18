<?php /** @var  \Arcanesoft\Seo\Models\Meta  $seo */ ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">SEO Metas</h3>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive">
            <table class="table table-condensed table-hover no-margin">
                <tr>
                    <td>
                        <b>{{ trans('seo::metas.attributes.title') }} :</b><br>
                        {{ $seo->title }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>{{ trans('seo::metas.attributes.description') }} :</b><br>
                        {{ $seo->description }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>{{ trans('seo::metas.attributes.keywords') }} :</b><br>
                        {{ $seo->keywords ? $seo->keywords->implode(', ') : '<null>' }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
