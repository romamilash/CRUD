<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genres}}`.
 */
class m250125_172549_create_genres_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genres}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%genres}}', ['name'], [
            ['Экшен'],
            ['Аркада'],
            ['Хоррор'],
            ['Шутер'],
            ['Платформер'],
            ['Файтинг'],
            ['Квест'],
            ['RPG'],
            ['Спорт'],
            ['Гонки'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%genres}}');
    }
}
