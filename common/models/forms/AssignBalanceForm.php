<?php
namespace common\models\forms;

use common\models\Balance;
use yii\base\Model;
use Yii;

/**
 * Class AssignBalanceForm
 * @package common\models\forms
 */
class AssignBalanceForm extends Model
{
    public $likes;
    public $views;
    public $workId;

    /**
     * AssignBalanceForm constructor.
     * @param $data
     * @param array $config
     */
    public function __construct($data,array $config = [])
    {
        $this->likes = $data['likes_work'];
        $this->views = $data['views_work'];
        $this->workId = $data['work_id'];

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

           ['workId', 'required'],
           [['likes','views'], 'checkRequired'],
           [['likes','views'], 'checkBalance'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'likes' => 'лайков',
            'views' => 'просмотров',
        ];
    }

    /**
     * Проверяет что заданы или лайки или просмотры
     */
    public function checkRequired()
    {
        if(empty($this->likes) && empty($this->views)){
            $this->addError('error','Введите количество лайков или просмотров!');
        }
    }

    /**
     * Проверяет баланс
     * @param $attribute
     * @param $params
     */
    public function checkBalance($attribute, $params)
    {
        $balance = Balance::findOne(['user_id'=> Yii::$app->user->getId()]);

        if($this->{$attribute} > $balance->{$attribute}){
            $this->addError('error',"Не достаточно {$this->getAttributeLabel($attribute)} на балансе!");
        }
    }
}
