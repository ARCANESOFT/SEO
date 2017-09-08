<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Redirects;

/**
 * Class     CreateRedirectRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Redirects
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateRedirectRequest extends RedirectFormRequest
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
            'old_url' => ['required', 'string', $this->getOldUrlRule()],
            'new_url' => ['required', 'string'],
            'status'  => $this->getStatusRule(),
        ];
    }
}
