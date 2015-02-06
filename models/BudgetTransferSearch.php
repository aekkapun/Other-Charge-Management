<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BudgetTransfer;

/**
 * BudgetTransferSearch represents the model behind the search form about `app\models\BudgetTransfer`.
 */
class BudgetTransferSearch extends BudgetTransfer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'user_id'], 'integer'],
            [['from_bh', 'to_bh', 'amount', 'status', 'timestamp', 'source_ip','year'], 'safe'],
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
        $query = BudgetTransfer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         if (isset($_GET['BudgetTransferSearch']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $this->dep_id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'from_bh', $this->from_bh])
            ->andFilterWhere(['like', 'to_bh', $this->to_bh])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
}
