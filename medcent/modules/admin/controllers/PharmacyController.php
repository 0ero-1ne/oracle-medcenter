<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Pharmacy;
use app\models\PharmacySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PharmacyController implements the CRUD actions for Pharmacy model.
 */
class PharmacyController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pharmacy models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $searchModel = new PharmacySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pharmacy model.
     * @param int $ID ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($ID),
        ]);
    }

    /**
     * Creates a new Pharmacy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $model = new Pharmacy();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $drug = $model->DRUG;
                $price = $model->PRICE;
                $stock = $model->STOCK;
                $need_recipe = $model->NEED_RECIPE;
                $supplier = $model->SUPPLIER_ID;

                $command = Yii::$app->db->createCommand('
                    BEGIN system.pharmacy_tapi.create_drug(:drug, :price, :stock, :need_recipe, :supplier); END;
                ')
                ->bindParam(':drug', $drug)
                ->bindParam(':price', $price)
                ->bindParam(':stock', $stock)
                ->bindParam(':need_recipe', $need_recipe)
                ->bindParam(':supplier', $supplier)
                ->execute();

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pharmacy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }

        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $drug = $model->DRUG;
            $price = $model->PRICE;
            $stock = $model->STOCK;
            $need_recipe = $model->NEED_RECIPE;
            $supplier = $model->SUPPLIER_ID;

            $command = Yii::$app->db->createCommand('
                BEGIN system.pharmacy_tapi.update_drug(:id, :drug, :price, :stock, :need_recipe, :supplier); END;
            ')
            ->bindParam(':id', $ID)
            ->bindParam(':drug', $drug)
            ->bindParam(':price', $price)
            ->bindParam(':stock', $stock)
            ->bindParam(':need_recipe', $need_recipe)
            ->bindParam(':supplier', $supplier)
            ->execute();

            return $this->redirect(['view', 'ID' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pharmacy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $isAdmin = Yii::$app->user->identity->USER_ROLE === "manager";

        if (!Yii::$app->user->isGuest && !$isAdmin) {
            return $this->goHome();
        }
        
        $command = Yii::$app->db->createCommand('
            BEGIN system.pharmacy_tapi.delete_drug(:id); END;
        ')
        ->bindParam(':id', $ID)
        ->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pharmacy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return Pharmacy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = Pharmacy::findOne(['ID' => $ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
