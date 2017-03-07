<?php

use Arcanesoft\Seo\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoFootersTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateSeoFootersTable extends Migration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * CreateSeoFootersTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable('footers');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createSchema(function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->default(0);
            $table->string('name');
            $table->string('localization');
            $table->string('uri');
            $table->string('locale')->default(config('app.locale'));
            $table->timestamps();

            $table->unique(['uri', 'locale']);
        });
    }
}
