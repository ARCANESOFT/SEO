<?php

use Arcanesoft\Seo\Bases\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateSeoPagesTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateSeoPagesTable extends Migration
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * CreateSeoPagesTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable('pages');
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
            $table->string('name', 255);
            $table->text('content');
            $table->string('locale')->default(config('app.locale'));
            $table->timestamps();
        });
    }
}
