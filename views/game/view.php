<?php

use app\models\Game;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Game $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Видеоигры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить игру?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
