<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BudgetHeads;

/**
 * BudgetHeadsSearch represents the model behind the search form about `app\models\BudgetHeads`.
 */
class BudgetHeadsSearch extends BudgetHeads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['bh_name', 'bh_description', 'source_ip', 'timestamp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = BudgetHeads::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'bh_name', $this->bh_name])
            ->andFilterWhere(['like', 'bh_description', $this->bh_description])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
}
