<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resident}}`.
 */
class m240424_152302_create_resident_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resident}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resident}}');
    }
}
