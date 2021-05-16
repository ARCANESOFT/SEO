<?php declare(strict_types=1);

use Arcanesoft\Seo\Database\Migration as Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoRedirectsTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see \Arcanesoft\Seo\Models\Redirect
 */
class CreateSeoRedirectsTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSeoRedirectsTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable('redirects');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Migrate to database.
     */
    public function up(): void
    {
        $this->createSchema(function(Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('footer_id');
            $table->string('url');
            $table->timestamps();
        });
    }
}
