<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FinancialYear;

/**
 * FinancialYearSearch represents the model behind the search form about `app\models\FinancialYear`.
 */
class FinancialYearSearch extends FinancialYear
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'user_id'], 'integer'],
            [['year', 'total_fund', 'desc', 'dep_hod', 'timestamp', 'source_ip'], 'safe'],
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
        $query = FinancialYear::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($_GET['FinancialYearSearch']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $this->dep_id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'total_fund', $this->total_fund])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'dep_hod', $this->dep_hod])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
    
    public function usersearch($params, $data)
    {
        $query = FinancialYear::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $data,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'total_fund', $this->total_fund])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'dep_hod', $this->dep_hod])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
    

}
