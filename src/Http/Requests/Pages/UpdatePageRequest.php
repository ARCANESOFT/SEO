<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Requests\Pages;

use Arcanesoft\Seo\Policies\PagesPolicy;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     UpdatePageRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdatePageRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the authorization.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return PagesPolicy::can('update');
    }

    /**
     * Get the validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'lang'    => ['required', 'string', 'max:2'],
            'content' => ['required', 'string'],
        ];
    }
}
