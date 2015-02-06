<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
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
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'user_id'], 'integer'],
            [['desc', 'remark'], 'string'],
            [['timestamp'], 'safe'],
            [['finance_year'], 'string', 'max' => 10],
            [['bh_name', 'bill_amount', 'source_ip'], 'string', 'max' => 20],
            [['bill_date', 'outstnd_adv', 'status'], 'string', 'max' => 15],
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
            'id' => 'ID',
            'dep_id' => 'Dep ID',
            'finance_year' => 'Finance Year',
            'bh_name' => 'Bh Name',
            'bill_amount' => 'Bill Amount',
            'bill_date' => 'Bill Date',
            'bill_no' => 'Bill No',
            'bill_diary_no' => 'Bill Diary No',
            'payment_info' => 'Payment Info',
            'desc' => 'Desc',
            'outstnd_adv' => 'Outstnd Adv',
            'status' => 'Status',
            'remark' => 'Remark',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
            'user_id' => 'User ID',
        ];
    }
}
