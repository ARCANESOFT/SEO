<?php declare(strict_types=1);

use Arcanesoft\Seo\Database\Migration as Migration;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoMetasTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see \Arcanesoft\Seo\Models\Meta
 */
class CreateSeoMetasTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSeoMetasTagsTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Seo::table('metas', 'metas', false));
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
            $table->morphs('metable');
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }
}
