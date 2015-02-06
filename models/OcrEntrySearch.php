<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OcrEntry;

/**
 * OcrEntrySearch represents the model behind the search form about `app\models\OcrEntry`.
 */
class OcrEntrySearch extends OcrEntry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dep_id', 'user_id'], 'integer'],
            [['finance_year', 'opening_ammount', 'total_expend', 'avail_bal', 'timestamp', 'source_ip'], 'safe'],
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
        $query = OcrEntry::find();

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
            ->andFilterWhere(['like', 'opening_ammount', $this->opening_ammount])
            ->andFilterWhere(['like', 'total_expend', $this->total_expend])
            ->andFilterWhere(['like', 'avail_bal', $this->avail_bal])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
    public function usersearch($params, $data)
    {
        $query = OcrEntry::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($_GET['OcrEntrySearch']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dep_id' => $data,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'finance_year', $this->finance_year])
            ->andFilterWhere(['like', 'opening_ammount', $this->opening_ammount])
            ->andFilterWhere(['like', 'total_expend', $this->total_expend])
            ->andFilterWhere(['like', 'avail_bal', $this->avail_bal])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
}
