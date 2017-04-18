<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Redirects;

/**
 * Class     UpdateRedirectRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Redirects
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateRedirectRequest extends RedirectFormRequest
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
        $redirect = $this->route('seo_redirect');

        return [
            'old_url' => ['required', 'string', $this->getOldUrlRule()->ignore($redirect->id)],
            'new_url' => ['required', 'string'],
            'status'  => $this->getStatusRule(),
        ];
    }
}
