<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "financial_year_tbl".
 *
 * @property integer $id
 * @property integer $dep_id
 * @property string $year
 * @property string $total_fund
 * @property string $desc
 * @property integer $user_id
 * @property string $dep_hod
 * @property string $timestamp
 * @property string $source_ip
 *
 * @property DeptDetails $dep
 */
class FinancialYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'financial_year_tbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'user_id','year','total_fund'], 'required'],
            [['dep_id', 'user_id'], 'integer'],
            [['desc'], 'string'],
            [['timestamp'], 'safe'],
            [['year'], 'string', 'max' => 10],
	    [['total_fund'], 'number'],
            [['dep_hod'], 'string', 'max' => 50],
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
            'year' => 'Financial Year',
            'total_fund' => 'Total Fund',
            'desc' => 'Description',
            'user_id' => 'User ID',
            'dep_hod' => 'H.O.D.',
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
