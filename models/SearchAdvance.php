<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Advance;

/**
 * SearchAdvance represents the model behind the search form about `app\models\Advance`.
 */
class SearchAdvance extends Advance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exp_id', 'dep_id', 'user_id'], 'integer'],
            [['year', 'bh_name', 'amount', 'drawn_on','settled_on','status_adv', 'timestamp', 'source_ip'], 'safe'],
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
       // var_dump($params);die;
        $query = Advance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (isset($_GET['SearchAdvance']) && !($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'exp_id' => $this->exp_id,
            'dep_id' => $this->dep_id,
            'timestamp' => $this->timestamp,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'bh_name', $this->bh_name])            
                ->andFilterWhere(['like', 'amount', $this->amount])
                ->andFilterWhere(['like', 'drawn_on', $this->drawn_on])
                ->andFilterWhere(['like', 'settled_on', $this->settled_on])                
            ->andFilterWhere(['like', 'status_adv', $this->status_adv])
            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);

        return $dataProvider;
    }
    
//    public function usersearch($params, $data)
//    {
//       // var_dump($params);die;
//        $query = Advance::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        if ($this->load($params) && !$this->validate()) {
//            return $dataProvider;
//        }
//
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'exp_id' => $this->exp_id,
//            'dep_id' =>$data,
//            'timestamp' => $this->timestamp,
//            'user_id' => $this->user_id,
//        ]);
//
//        $query->andFilterWhere(['like', 'year', $this->year])
//            ->andFilterWhere(['like', 'bh_name', $this->bh_name])
//            ->andFilterWhere(['like', 'amount', $this->amount])
//            ->andFilterWhere(['like', 'status_adv', $this->status_adv])
//            ->andFilterWhere(['like', 'source_ip', $this->source_ip]);
//
//        return $dataProvider;
//    }
}
