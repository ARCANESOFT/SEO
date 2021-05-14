<?php

declare(strict_types=1);

use Arcanesoft\Seo\Database\Migration as Migration;
use Arcanesoft\Seo\Seo;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoFootersTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateSeoFootersTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSeoFooterTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Seo::table('footers', 'footers', false));
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
            $table->unsignedBigInteger('page_id')->default(0);
            $table->unsignedInteger('order')->default(0);
            $table->string('url');
            $table->string('name');
            $table->json('placeholder');

            // TODO: Use a dynamic SEO metas
            $table->string('title');
            $table->string('description', 255);
            $table->string('keywords', 255);

            $table->timestamps();
        });
    }
}
