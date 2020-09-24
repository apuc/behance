<?php


namespace frontend\modules\cabinet\controllers;


use common\models\HistoryCash;
use common\models\Social;
use common\models\SupportAnswers;
use common\models\SupportQuestions;
use frontend\modules\api\controllers\ApiController;
use frontend\modules\api\services\TelegramApiServices;
use frontend\modules\cabinet\models\SupportSearch;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class SupportController extends Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SupportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
     public function actionView($id)
     {
         $model1 = $this->findModel($id);
         $model0 = new SupportAnswers();
         if ($model0->load(Yii::$app->request->post())) {
             $model0->question_id = $id;
             $model0->status = 0;
             $model1->status = 1;
             $model1->save();
             $model0->save();
             return $this->redirect(['view', 'id' => $id]);
         }elseif($model1->status == 2){

             $model1->status = 0;
             $model1->save();
         }

         return $this->render('view', [
             'model' => $this->findModel($id),
             'model0' => $model0,
         ]);
     }


    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        //$socials = $this->getSocials();
        $model = new SupportQuestions();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->date_add = new \yii\db\Expression('NOW()');
            $model->status = 1;
            $model->save();
            $messenger = new TelegramApiServices(Yii::$app->params['telegram_api_url']);
            //$messenger->sendTelegramMessage(Yii::$app->name,
            //    "<b>Новое сообщение в тех поддержку!</b>\n\n<b>Тема: </b>$model->title\n<b>Описание: </b>$model->description\n");

            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * @param $id
     * @return SupportQuestions|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = SupportQuestions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('support', 'The requested page does not exist.'));
    }

    /**
     * @return array
     */
    /*private function getSocials()
    {
        $socials = [];
        foreach (Social::find()->all() as $social)
        {
            $socials[$social->name] = $social->name;
        }
        return $socials;
    }*/
}