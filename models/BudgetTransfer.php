<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "budget_transfer".
 *
 * @property integer $id
 * @property integer $dep_id
 * @property string $from_bh
 * @property string $to_bh
 * @property string $amount
 * @property string $status
 * @property integer $user_id
 * @property string $timestamp
 * @property string $source_ip
 */
class BudgetTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget_transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_id', 'user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['from_bh', 'to_bh'], 'string', 'max' => 40],
            [['year'], 'string', 'max' => 10],
            [['amount'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 15],
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
            'from_bh' => 'From Budget Head',
            'to_bh' => 'To Budget Head',
            'amount' => 'Amount',
            'status' => 'Status',
            'user_id' => 'User ID',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
            'year' => 'Year',
        ];
    }
}
