<?php

namespace app\models;
use yii\validators\NumberValidator;

use Yii;

/**
 * This is the model class for table "budget".
 *
 * @property integer $id
 * @property integer $dep_id
 * @property string $year
 * @property string $date_order
 * @property string $file_ref_no
 * @property string $budget_head
 * @property string $bh_fund
 * @property integer $deduction
 * @property string $bh_netfund
 * @property string $bh_desc
 * @property integer $user_id
 * @property string $timestamp
 * @property string $source_ip
 *
 * @property DeptDetails $dep
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['dep_id', 'user_id','year','bh_fund'], 'required' ],
            [['dep_id', 'user_id','deduction'], 'integer' ],
            
            [[ 'timestamp'], 'safe'],
            [['bh_desc'], 'string'],
            [['date_order'], 'string', 'max' => 12],
            [['year'], 'string', 'max' => 10],
             
            [['file_ref_no'], 'string', 'max' => 50],
            [['budget_head'], 'string', 'max' => 30],
            [['bh_netfund','bh_fund'], 'number'],
            
            [['source_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dep_id' => 'Department',
            'year' => 'Year',
            'date_order' => 'Date Order',
            'file_ref_no' => 'File Reference No.',
            'budget_head' => 'Budget Head',
            'bh_fund' => 'Fund Allocated',
            'deduction' => 'Deduction',
            'bh_netfund' => 'Available Fund',
            'bh_desc' => 'Description',
            'user_id' => 'User ID',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
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
