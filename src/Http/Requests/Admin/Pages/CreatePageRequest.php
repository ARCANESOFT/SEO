<?php namespace Arcanesoft\Seo\Http\Requests\Admin\Pages;

/**
 * Class     CreatePageRequest
 *
 * @package  Arcanesoft\Seo\Http\Requests\Admin\Pages
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreatePageRequest extends PageFormRequest
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
            'name'    => ['required', 'string'],
            'locale'  => $this->getLocaleRule(),
            'content' => ['required', 'string'],
        ];
    }
}
