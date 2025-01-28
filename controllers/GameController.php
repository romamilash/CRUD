<?php

namespace api;

use app\models\Game;
use app\models\GameSearch;
use app\models\Genre;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends ActiveController
{
    public $modelClass = 'app\models\Game';
    /**
     * Lists all Game models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Game model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new Game model.
     * @return Game | array
     */
    public function actionCreate()
    {
        $model = new Game();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($this->request->post()['Game']['genre_id'] as $genre) {
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->unlinkAll('genres');

            foreach ($this->request->post()['Game']['genre_id'] as $genre) {
                $model->link('genres', Genre::findOne(['id' => $genre]));
            }

            return $model;
        } else {
            return $model->getErrors();
        }
    }

    /**
     * Deletes an existing Game model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return ['success' => true];
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
