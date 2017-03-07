<?php namespace Arcanesoft\Seo\Http\Requests\Admin;

use Arcanedev\Support\Bases\FormRequest as BaseFormRequest;
use Arcanesoft\Seo\Entities\Locales;

/**
 * Class     FormRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class FormRequest extends BaseFormRequest
{
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get the local validation rule.
     *
     * @return array
     */
    protected function getLocaleRule()
    {
        return ['required', 'in:'.Locales::keys()->implode(',')];
    }

    /**
     * Get the table prefix.
     *
     * @return string
     */
    protected function getTablePrefix()
    {
        return config('arcanesoft.seo.database.prefix', 'seo_');
    }
}
