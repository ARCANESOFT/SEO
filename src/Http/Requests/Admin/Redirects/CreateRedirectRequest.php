<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Redirects;

use Arcanedev\LaravelSeo\Entities\RedirectStatuses;
use Arcanedev\Support\Bases\FormRequest;

/**
 * Class     CreateRedirectRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Redirects
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateRedirectRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_url' => ['required'],
            'new_url' => ['required'],
            'status'  => ['required', 'integer', 'in:'.RedirectStatuses::keys()->implode(',')],
        ];
    }
}
