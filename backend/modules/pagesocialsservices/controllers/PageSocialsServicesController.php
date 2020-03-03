<?php

namespace backend\modules\pagesocialsservices\controllers;

use common\models\PageSocials;
use Yii;
use common\models\PageSocialsServices;
use backend\modules\pagesocialsservices\models\PageSocialsServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageSocialsServicesController implements the CRUD actions for PageSocialsServices model.
 */
class PageSocialsServicesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PageSocialsServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSocialsServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $socials = $this->getPageSocials();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'socials' => $socials
        ]);
    }

    /**
     * Displays a single PageSocialsServices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $social = PageSocials::find()->where(['id' => $model->id_social])->one();
        return $this->render('view', [
            'model' => $model,
            'social' => $social,
        ]);
    }

    /**
     * Creates a new PageSocialsServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PageSocialsServices();
        $model->service_seo_title = "";
        $model->service_seo_descr = "";
        $model->service_seo_keywords = "";
        $socials = $this->getPageSocials();
        $errors = null;

        $data = Yii::$app->request->post();
        if ($model->load($data)) {
            $model->service_seo = json_encode(
                [
                    'title' => $data['PageSocialsServices']['service_seo_title'],
                    'descr' => $data['PageSocialsServices']['service_seo_descr'],
                    'keywords' => $data['PageSocialsServices']['service_seo_keywords'],
                ]
            );
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'socials' => $socials,
        ]);
    }

    /**
     * Updates an existing PageSocialsServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if ($model->load($data)) {
            $model->service_seo = json_encode(
                [
                    'title' => $model->service_seo_title,
                    'descr' =>  $model->service_seo_descr,
                    'keywords' => $model->service_seo_keywords,
                ]
            );
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $seo = json_decode($model->service_seo);
            $model->service_seo_title = $seo->title;
            $model->service_seo_descr = $seo->descr;
            $model->service_seo_keywords = $seo->keywords;
        }
        $socials = $this->getPageSocials();
        return $this->render('update', [
            'model' => $model,
            'socials' => $socials
        ]);
    }

    /**
     * Deletes an existing PageSocialsServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PageSocialsServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PageSocialsServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PageSocialsServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    private function getPageSocials() {
        $socials_original = PageSocials::find()->all();
        $socials = [];
        foreach ($socials_original as $social){
            /**
             * @var $social PageSocials
             */
            $socials[$social->id] = $social->social_title;
        }
        return $socials;
    }
}
