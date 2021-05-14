<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Controllers;

/**
 * Class     FootersController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->view('footers.index');
    }
}
