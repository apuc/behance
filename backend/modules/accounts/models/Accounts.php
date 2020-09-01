<?php

namespace backend\modules\Accounts\models;

use common\behance\lib\BehanceAccount;
use common\models\Debug;
use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property string $url
 * @property string $title
 * @property int $behance_id
 * @property string $display_name
 * @property string $username
 * @property string $image
 */
class Accounts extends \common\models\Accounts
{
	//	public function beforeSave( $insert ) {
//		$post = $_POST['Accounts'];
//		if($post['url']){
//			$acc = new BehanceAccount($post['url']);
//			Debug::toDebug($acc);
//			$this->username = $acc->username;
//			$this->behance_id = $acc->behanceId;
//			$this->image = $acc->image;
//			$this->display_name = $acc->displayName;
//			$this->url = $acc->url;
//			$this->save();
//		}
//	}

}
