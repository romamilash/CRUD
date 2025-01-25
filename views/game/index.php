<?php

use app\models\Game;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\GameSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Видеоигры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить игру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'developer',
            [
                'attribute' => 'genre_id',
                'format' => 'raw',
                'value' => function($data /* @var $data \app\models\Game */) {
                    $html = "";
                    foreach (Game::findGameGenres($data->genres) as $genre) {
                        $html .= $genre . "<br>";
                    }
                    return $html;
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Game $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
