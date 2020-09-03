<?php


namespace frontend\controllers;

use common\models\PageSocialsServices;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

class SitemapController extends Controller
{
    public function actionMap()
    {
        $socials = PageSocialsServices::find()->all();
        $siteMaps[] = [
            'loc' =>  '',
            'lastmod' => '2020-03-30',
            'changefreq' => 'monthly',
            'priority' => '1'
        ];
        $siteMaps[] = [
            'loc' =>  'about',
            'lastmod' => '2020-03-30',
            'changefreq' => 'monthly',
            'priority' => '0.9'
        ];
        foreach ($socials as $social){
            $siteMaps[] = [
                'loc' =>  'social/' . $social->service_page_link,
                'lastmod' => '2020-03-30',
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ];
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
        return $this->renderPartial('index', [
            'siteMaps' => $siteMaps
        ]);
    }
}