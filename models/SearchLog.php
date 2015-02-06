<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Log;

/**
 * SearchLog represents the model behind the search form about `app\models\Log`.
 */
class SearchLog extends Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'user_id'], 'integer'],
            [['finance_year', 'bh_name', 'bill_amount', 'bill_date', 'bill_no', 'bill_diary_no', 'payment_info', 'desc', 'outstnd_adv', 'status', 'remark', 'timestamp', 'source_ip'], 'safe'],
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
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $this->dep_id,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'finance_year', $this->finance_year])
            ->andFilterWhere(['like', 'bh_name', $this->bh_name])
            ->andFilterWhere(['like', 'bill_amount', $this->bill_amount])
            ->andFilterWhere(['like', 'bill_date', $this->bill_date])
            ->andFilterWhere(['like', 'bill_no', $this->bill_no])
            ->andFilterWhere(['like', 'bill_diary_no', $this->bill_diary_no])
            ->andFilterWhere(['like', 'payment_info', $this->payment_info])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'outstnd_adv', $this->outstnd_adv])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
}
