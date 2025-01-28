<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string $name
 * @property string $developer
 * @property array $genres
 */
class Game extends \yii\db\ActiveRecord
{
    public $genre_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'developer', 'genre_id'], 'required'],
            [['name', 'developer'], 'string', 'max' => 255],
            [['genre_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'developer' => 'Разработчик',
            'genre_id' => 'Жанр',
        ];
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::class, ['id' => 'genres_id'])->viaTable('games_genres', ['games_id' => 'id']);
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'developer',
            'genre_id' => function () {
                return $this->genres;
            }
        ];
    }
}
