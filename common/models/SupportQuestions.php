<?php


namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "support_questions".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $user_id
 * @property int $date_add
 */

class SupportQuestions extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_PAUSE = 2;
    const STATUS_CLOSE = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id'], 'integer'],
            [['title', 'description'], 'string'],
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
            'title' => Yii::t('support', 'Тема'),
            'description' => Yii::t('support', 'Описание'),
            'status' => Yii::t('support', 'Статус'),
            'user_id' => Yii::t('support', 'Email'),
            'date_add' => Yii::t('support', 'Дата'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasMany(SupportAnswers::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public static function getStatus($id)
    {
        $statuses = [self::STATUS_ACTIVE => 'Открыт',
            self::STATUS_INACTIVE => 'Ожидание',
            self::STATUS_PAUSE => 'Отвечен',
            self::STATUS_CLOSE => 'Закрыт'];

        return isset($statuses[$id]) ? $statuses[$id] : null;
    }

}