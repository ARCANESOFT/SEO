<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Redirects;

use Arcanedev\LaravelSeo\Entities\RedirectStatuses;
use Arcanedev\LaravelSeo\Seo;
use Arcanesoft\Seo\Http\Requests\Admin\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class     RedirectFormRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Redirects
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RedirectFormRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get the `old_url` unique rule.
     *
     * @param  string  $column
     *
     * @return \Illuminate\Validation\Rules\Unique
     */
    public function getOldUrlRule($column = 'old_url')
    {
        $table = Seo::getConfig('database.prefix').Seo::getConfig('redirects.table');

        return Rule::unique($table, $column);
    }

    /**
     * Get `status` rule.
     *
     * @return array
     */
    protected function getStatusRule()
    {
        return ['required', 'integer', 'in:'.RedirectStatuses::keys()->implode(',')];
    }
}
