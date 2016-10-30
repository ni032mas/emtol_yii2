<?php

namespace backend\controllers;

use backend\models\ReservationinfoMany;
use DateTime;
use Yii;
use backend\models\Reservationinfo;
use backend\models\ReservationinfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReservationinfoController implements the CRUD actions for Reservationinfo model.
 */
class ReservationinfoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['objreservationid', 'index', 'view', 'create', 'create-many', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reservationinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservationinfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionObjreservationid($objreservation_id)
    {
        $searchModel = new ReservationinfoSearch();
        $dataProvider = $searchModel->search([$searchModel->formName() => ['objreservation_id' => $objreservation_id]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservationinfo model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reservationinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reservationinfo();

        if ($model->load(Yii::$app->request->post())) {
            $model->date_begin = Yii::$app->formatter->asTimestamp($model->dateBegin);
            $model->date_end = Yii::$app->formatter->asTimestamp($model->dateEnd);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateMany()
    {
        $model = new ReservationinfoMany();
        if ($model->load(Yii::$app->request->post())) {
            $dateBegin = Yii::$app->formatter->asTimestamp($model->dateBegin);
            $dateEnd = Yii::$app->formatter->asTimestamp($model->dateEnd);

            $daysOfWeek = [
                $model->monday ? true : null,
                $model->tuesday ? true : null,
                $model->wednesday ? true : null,
                $model->thursday ? true : null,
                $model->friday ? true : null,
                $model->saturday ? true : null,
                $model->sunday ? true : null,
            ];
            $qty = (int)($dateEnd - $dateBegin) / 86400;
            if ($qty > 60) {
                Yii::$app->session->setFlash('danger', 'Вы пытаетесь создать экскурсии больше чем на 60 дней. Невозможно создать!');
            } else {
                for ($i = 0; $i < $qty; $i++) {
                    if (isset($daysOfWeek[date('N', $dateBegin)])) {
                        $reservationInfo = new Reservationinfo();
                        $reservationInfo->date_begin = $dateBegin;
                        $reservationInfo->date_end = $dateBegin + ($model->hour * 3600);
                        $reservationInfo->objreservation_id = $model->objreservationId;
                        $reservationInfo->qty = $model->qty;
                        $reservationInfo->price = $model->price;
                        $reservationInfo->save();
                    }
                    $dateBegin += 86400;
                }
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Не все поля заполнены. Невозможно создать!');
        }
        return $this->render('create-many', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Reservationinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->date_begin = Yii::$app->formatter->asDatetime($model->date_begin);
        $model->date_end = Yii::$app->formatter->asDatetime($model->date_end);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model->date_begin = strtotime($model->date_begin);
            $model->date_begin = Yii::$app->formatter->asTimestamp($model->date_begin);
            $model->date_end = Yii::$app->formatter->asTimestamp($model->date_end);
//            $model->date_end = strtotime($model->date_end);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reservationinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reservationinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reservationinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservationinfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
