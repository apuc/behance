<?php
namespace frontend\modules\cabinet\models;

use Yii;
/**
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $link_id
 * @property int|null $type_id
 * @property string|null $dt_add
 * @property string|null $link
 * @property string|null $msg
 * @property string|null $gender
 * @property int|null $status
 * @property int $balance
 * @property int|null $social
 * @property int|null $answer_id
 * @property int|null $friends_id
 * @property int|null $age_min
 * @property int|null $age_max
 * @property int $price
 */
class SocialQueueForm extends \common\models\SocialQueue
{
    public $social;
    public $link;
    public $msg;
    public $balance;
    public $answer_id;
    public $friends_id;
    public $age_min;
    public $age_max;
    public $gender;
    public $price;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [
            ['type_id'], 'required', 'when' => function($model) {
                return empty($model->type_id);
            }, 'message' => 'Тип услуги обязательно должен быть выбран'
        ];
        $rules[] = [['social', 'answer_id', 'age_min', 'age_max', 'balance', 'friends_id', 'price'], 'integer'];
        $rules[] = [
            ['balance'], 'required', 'when' => function($model) {
                return empty($model->balance);
            }, 'message' => 'Не должен быть пустым или содержать что-то кроме цифр'
        ];
        $rules[] = [['link'], 'url'];
        $rules[] = [['msg'], 'string', 'max' => 140];
        $rules[] = [['gender'], 'string', 'max' => 1];
        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['social'] = Yii::t('social', 'social');
        $labels['answer_id'] = Yii::t('social', 'answer');
        $labels['friends_id'] = Yii::t('social', 'friends');
        $labels['balance'] = Yii::t('social', 'balance');
        $labels['link'] = Yii::t('social', 'link');
        $labels['msg'] = Yii::t('social', 'msg');
        $labels['age_min'] = Yii::t('social', 'age_min');
        $labels['age_max'] = Yii::t('social', 'age_max');
        $labels['gender'] = Yii::t('social', 'gender');
        return $labels;
    }
}