<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Game $model */
/** @var app\models\Genre $genres */

$this->title = 'Добавить игру';
$this->params['breadcrumbs'][] = ['label' => 'Видеоигры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'genres' => $genres,
    ]) ?>

</div>
