<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Game $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Genre $genres */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'developer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genre_id')->listBox($genres,
        [
            'multiple' => true,
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
