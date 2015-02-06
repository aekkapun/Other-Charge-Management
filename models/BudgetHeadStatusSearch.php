<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BudgetHeadStatus;

/**
 * BudgetHeadStatusSearch represents the model behind the search form about `app\models\BudgetHeadStatus`.
 */
class BudgetHeadStatusSearch extends BudgetHeadStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id'], 'integer'],
           [['year', 'bh_name', 'bh_total_amount', 'bh_expend', 'bh_balance', 'timestamp', 'bh_advance'], 'safe'],
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
        $query = BudgetHeadStatus::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($_GET['BudgetHeadStatusSearch']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' =>  $this->dep_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'bh_name', $this->bh_name])
            ->andFilterWhere(['like', 'bh_total_amount', $this->bh_total_amount])
            ->andFilterWhere(['like', 'bh_expend', $this->bh_expend])
            ->andFilterWhere(['like', 'bh_balance', $this->bh_balance])
            ->andFilterWhere(['like', 'bh_advance', $this->bh_advance]);

        return $dataProvider;
    }
    
}
