<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ocr_entry".
 *
 * @property integer $id
 * @property integer $dep_id
 * @property string $finance_year
 * @property string $opening_ammount
 * @property string $total_expend
 * @property string $avail_bal
 * @property string $timestamp
 * @property string $source_ip
 * @property integer $user_id
 *
 * @property DeptDetails $dep
 */
class OcrEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocr_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['finance_year'], 'string', 'max' => 10],
            [['opening_ammount', 'total_expend', 'avail_bal'], 'string', 'max' => 15],
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
            'finance_year' => 'Financial Year',
            'opening_ammount' => 'Opening Amount',
            'total_expend' => 'Total Expenditure',
            'avail_bal' => 'Available Balance',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
            'user_id' => 'User ID',
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
