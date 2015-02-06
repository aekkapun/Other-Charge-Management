<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeptDetails;

/**
 * DeptDetailsSearch represents the model behind the search form about `app\models\DeptDetails`.
 */
class DeptDetailsSearch extends DeptDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dept_id'], 'integer'],
            [['dep_name', 'dep_email', 'dep_phone', 'dep_ext', 'dep_fax', 'dep_hod', 'profile', 'dep_address_line1', 'dep_city', 'dep_pin', 'dep_state', 'dep_year', 'dep_hod_photo', 'dep_logo', 'dep_website', 'dep_bulletin', 'ip', 'timestamp'], 'safe'],
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
        $query = DeptDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($this->load($params) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dept_id' => $this->dept_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'dep_name', $this->dep_name])
            ->andFilterWhere(['like', 'dep_email', $this->dep_email])
            ->andFilterWhere(['like', 'dep_phone', $this->dep_phone])
            ->andFilterWhere(['like', 'dep_ext', $this->dep_ext])
            ->andFilterWhere(['like', 'dep_fax', $this->dep_fax])
            ->andFilterWhere(['like', 'dep_hod', $this->dep_hod])
            ->andFilterWhere(['like', 'profile', $this->profile])
            ->andFilterWhere(['like', 'dep_address_line1', $this->dep_address_line1])
            ->andFilterWhere(['like', 'dep_city', $this->dep_city])
            ->andFilterWhere(['like', 'dep_pin', $this->dep_pin])
            ->andFilterWhere(['like', 'dep_state', $this->dep_state])
            ->andFilterWhere(['like', 'dep_year', $this->dep_year])
            ->andFilterWhere(['like', 'dep_hod_photo', $this->dep_hod_photo])
            ->andFilterWhere(['like', 'dep_logo', $this->dep_logo])
            ->andFilterWhere(['like', 'dep_website', $this->dep_website])
            ->andFilterWhere(['like', 'dep_bulletin', $this->dep_bulletin])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
