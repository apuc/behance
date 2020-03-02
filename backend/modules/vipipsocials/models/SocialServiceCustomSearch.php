<?php
namespace backend\modules\vipipsocials\models;
use common\models\SocialQueue;
use common\models\SocialService;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * @property string $social_name
 */
class SocialServiceCustomSearch extends \common\models\SocialService
{
    public function  __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
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
        $query = SocialService::find();
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
            'id_soc' => $this->id_soc,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        return $dataProvider;

    }
}