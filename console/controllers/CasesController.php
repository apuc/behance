<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Cases;
use yii\helpers\Console;

class CasesController extends Controller
{
	public function actionInit()
	{
		$data = [
			'1' => ['name' => 'Light Start', 'likes' => 100, 'views' => 1000, 'img' => '/uploads/global/ico-paper-plane.png', 'term' => '1 день', 'price' => '500.00'],
			'2' => ['name' => 'Start', 'likes' => 250, 'views' => 2000, 'img' => '/uploads/global/ico-plane.png', 'term' => '1-2 день', 'price' => '1000.00'],
			'3' => ['name' => 'Fast Start', 'likes' => 100, 'views' => 5000, 'img' => '/uploads/global/ico-rocket.png', 'term' => '5-6 дней', 'price' => '2000.00'],
			'4' => ['name' => 'maximum', 'likes' => 2000, 'views' => 10000, 'img' => '/uploads/global/ico-diamond.png', 'term' => '10 дней', 'price' => '5000.00']
		];
		foreach ($data as $item) {
			$cases = new Cases();
			$cases->name = $item['name'];
			$cases->likes = $item['likes'];
			$cases->views = $item['views'];
			$cases->img = $item['img'];
			$cases->term = $item['term'];
			$cases->price = $item['price'];
			$cases->status = 1;
			$cases->save();
		}
		$this->stdout("Complete!\n",Console::FG_GREEN);
	}
}