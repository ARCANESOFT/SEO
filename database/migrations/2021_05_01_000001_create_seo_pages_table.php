<?php declare(strict_types=1);

use Arcanesoft\Seo\Database\Migration as Migration;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoPagesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see \Arcanesoft\Seo\Models\Page
 */
class CreateSeoPagesTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSeoPagesTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Seo::table('pages', 'pages', false));
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
            $table->string('name');
            $table->text('content');
            $table->string('lang')->default(app()->getLocale());
            $table->timestamps();
        });
    }
}
