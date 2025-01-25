<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Game $model */
/** @var app\models\Genre $genres */

$this->title = 'Update Game: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Видеоигры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'genres' => $genres,
    ]) ?>

</div>
