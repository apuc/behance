<?php

namespace frontend\modules\cabinet\models;

use common\models\Accounts;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\cabinet\models\Works;
use Yii;
use yii\helpers\ArrayHelper;


/**
 * WorksSearch represents the model behind the search form of `frontend\modules\cabinet\models\Works`.
 */
class WorksSearch extends Works
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['behance_id', 'url', 'name', 'image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $account_id = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->select('id')->all();
        $account_id = ArrayHelper::getColumn($account_id,'id');
        $account_id = implode(',',$account_id);

        $query = Works::find()->where("account_id IN({$account_id})");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
        ]);

        $query->andFilterWhere(['like', 'behance_id', $this->behance_id])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
