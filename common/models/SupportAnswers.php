<?php


namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "support_answers".
 *
 * @property int $id
 * @property int $question_id
 * @property string $text
 * @property int $status
 * @property int $date_add
 */

class SupportAnswers extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'status'], 'integer'],
            [['text'], 'string'],
            [['date_add'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('support', 'ID'),
            'question_id' => Yii::t('support', 'ID Вопроса'),
            'text' => Yii::t('support', 'Ответ'),
            'status' => Yii::t('support', 'Статус'),
            'date_add' => Yii::t('support', 'Дата'),
        ];
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getStatus($id)
    {
        $statuses = [self::STATUS_ACTIVE => 'Тех. Поддержка',
            self::STATUS_INACTIVE => 'Вы'];

        return isset($statuses[$id]) ? $statuses[$id] : null;
    }
}