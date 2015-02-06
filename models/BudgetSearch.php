<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Budget;

/**
 * BudgetSearch represents the model behind the search form about `app\models\Budget`.
 */
class BudgetSearch extends Budget
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'deduction', 'user_id'], 'integer'],
            [['year', 'date_order', 'file_ref_no', 'budget_head', 'bh_fund', 'bh_netfund', 'bh_desc', 'timestamp', 'source_ip'], 'safe'],
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
        $query = Budget::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $this->dep_id,
           // 'date_order' => $this->date_order,
            'deduction' => $this->deduction,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'date_order', $this->date_order])
              ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'file_ref_no', $this->file_ref_no])
            ->andFilterWhere(['like', 'budget_head', $this->budget_head])
            ->andFilterWhere(['like', 'bh_fund', $this->bh_fund])
            ->andFilterWhere(['like', 'bh_netfund', $this->bh_netfund])
            ->andFilterWhere(['like', 'bh_desc', $this->bh_desc])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
    
    public function usersearch($params, $data)
    {
        $query = Budget::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $data,
            'date_order' => $this->date_order,
            'deduction' => $this->deduction,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'file_ref_no', $this->file_ref_no])
            ->andFilterWhere(['like', 'budget_head', $this->budget_head])
            ->andFilterWhere(['like', 'bh_fund', $this->bh_fund])
            ->andFilterWhere(['like', 'bh_netfund', $this->bh_netfund])
            ->andFilterWhere(['like', 'bh_desc', $this->bh_desc])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
}
