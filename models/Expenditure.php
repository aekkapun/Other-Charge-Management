<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expenditure_tbl".
 *
 * @property integer $id
 * @property integer $dep_id
 * @property string $finance_year
 * @property string $bh_name
 * @property string $bill_amount
 * @property string $bill_date
 * @property string $bill_no
 * @property string $bill_diary_no
 * @property string $payment_info
 * @property string $desc
 * @property string $outstnd_adv
 * @property string $status
 * @property string $remark
 * @property string $timestamp
 * @property string $source_ip
 * @property integer $user_id
 *
 * @property DeptDetails $dep
 */
class Expenditure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenditure_tbl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'user_id','finance_year','bill_amount','bh_name'], 'required'],
            [['dep_id', 'user_id'], 'integer'],
            [['desc', 'remark'], 'string'],
            [['timestamp'], 'safe'],
            //[['finance_year'], 'string', 'max' => 10],
             [['finance_year','advance_status'],'string', 'max' => 10],
            [['drawn_on','settled_on'],'string', 'max' => 12], 
            [['bill_amount'], 
             'match', 'pattern'=>'/^[0-9.]{1,20}$/',
             'message'=>'Numbers only.'],
            [['outstnd_adv'], 'string', 'max' => 15],
            [['bh_name',  'source_ip'], 'string', 'max' => 20],
            [['bill_date', 'status'], 'string', 'max' => 15],
            [['bill_no', 'bill_diary_no'], 'string', 'max' => 50],
            [['payment_info'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'OCR No.',
            'dep_id' => 'Department',
            'finance_year' => 'Financial Year',
            'bh_name' => 'Budget Head',
            'bill_amount' => 'Amount',
            'bill_date' => 'Bill Date',
            'bill_no' => 'Bill No.',
            'bill_diary_no' => 'Bill Diary No',
            'payment_info' => 'Remarks',
            'desc' => 'Description',
            'outstnd_adv' => 'Type',
            'status' => 'Expenditure Status',
            'remark' => 'Admin Remark',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
            'user_id' => 'User ID',
            'advance_status' => 'Advance Status',
            'drawn_on' => 'Drawn On',
            'settled_on' => 'Settled On',
            
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
