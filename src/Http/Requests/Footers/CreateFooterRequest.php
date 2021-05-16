<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Requests\Footers;

use Arcanesoft\Seo\Policies\FootersPolicy;
use Arcanesoft\Seo\Seo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class     CreateFooterRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateFooterRequest extends FormRequest
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
        return FootersPolicy::can('create');
    }

    /**
     * The validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'url'          => ['required', 'string', 'max:255'], // TODO: Add slug validation rule
            'page'         => ['required', 'integer', Rule::exists(Seo::table('pages'), 'id')],
            'placeholders' => ['nullable', 'array'],
        ];
    }
}
