<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Expenditure;

/**
 * ExpenditureSearch represents the model behind the search form about `app\models\Expenditure`.
 */
class ExpenditureSearch extends Expenditure
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'user_id'], 'integer'],
            [['finance_year', 'bh_name', 'bill_amount', 'bill_date', 'bill_no', 'advance_status',
                'bill_diary_no', 'payment_info', 'desc', 'outstnd_adv','drawn_on', 'settled_on', 'status', 'remark', 'timestamp', 'source_ip'], 'safe'],
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
        $query = Expenditure::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (isset($_GET['ExpenditureSearch']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $this->dep_id,
            //' timestamp' => $this-> timestamp,
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
            ->andFilterWhere(['like', 'source_ip', $this->source_ip])
            ->andFilterWhere(['like', 'drawn_on', $this->drawn_on])
            ->andFilterWhere(['like', 'settled_on', $this->settled_on])
            ->andFilterWhere(['like', 'advance_status', $this->advance_status]);

        return $dataProvider;
    }
   
}
