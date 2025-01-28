<?php

namespace app\controllers;

use app\models\Game;
use app\models\GameSearch;
use app\models\Genre;
use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends ActiveController
{
    public $modelClass = 'app\models\Game';

    public function actions(){

        $actions = parent::actions();

        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);

        return $actions;
    }

    /* TODO разделить методы получения всех игр и поиска игры по жанру */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->bodyParams);
        return $dataProvider->getModels();
    }

    /**
     * Creates a new Game model.
     * @return Game | array
     */
    public function actionCreate()
    {
        $model = new Game();
        $params = $this->request->post();
        $model->name = $params['name'];
        $model->developer = $params['developer'];
        $model->genre_id = $params['genre_id'];

        if ($this->request->isPost) {
            if ($model->save()) {
                foreach ($params['genre_id'] as $genre) {
                    $model->link('genres', Genre::findOne(['id' => $genre]));
                }

                return $model;
            }
        } else {
            return $model->getErrors();
        }
    }

    /**
     * Updates an existing Game model.
     * @param int $id ID
     * @return Game | array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->post() && $model->load(Yii::$app->request->bodyParams, '') && $model->save()) {
            $model->unlinkAll('genres');

            foreach ($this->request->post()['genre_id'] as $genre) {
                $model->link('genres', Genre::findOne(['id' => $genre]));
            }

            return $model;
        } else {
            return $model->getErrors();
        }
    }

    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Game not found.');
    }
}
