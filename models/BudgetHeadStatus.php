<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "budget_head_status".
 *
 * @property integer $id
 * @property string $year
 * @property integer $dep_id
 * @property string $bh_name
 * @property string $bh_total_amount
 * @property string $bh_expend
 * @property string $bh_balance
 *  @property string $bh_advance 
 * @property string $timestamp
 *
 * @property DeptDetails $dep
 */
class BudgetHeadStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget_head_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['year'], 'string', 'max' => 10],
            [['bh_name', 'bh_advance'], 'string', 'max' => 20],
            [['bh_total_amount', 'bh_expend', 'bh_balance'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Financial Year',
            'dep_id' => 'Department',
            'bh_name' => 'Budget Head',
            'bh_total_amount' => 'Net Amount',
            'bh_expend' => 'Expenditure',
            'bh_balance' => 'Balance',
            'bh_advance' => 'Advances',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDep()
    {
        return $this->hasOne(DeptDetails::className(), ['dept_id' => 'dep_id']);
    }
    
}
