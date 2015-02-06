<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advance".
 *
 * @property integer $id
 * @property integer $exp_id
 * @property integer $dep_id
 * @property string $year
 * @property string $bh_name
 * @property string $amount
 * @property string $drawn_on 
 * @property string $settled_on 
 * @property string $status_adv
 * @property string $timestamp
 * @property string $source_ip
 * @property integer $user_id
 */
class Advance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exp_id', 'dep_id', 'year', 'bh_name', 'amount', 'status_adv', 'source_ip', 'user_id'], 'required'],
            [['exp_id', 'dep_id', 'user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['year'], 'string', 'max' => 10],
            [['bh_name', 'amount'], 'string', 'max' => 20],
            [['drawn_on', 'settled_on','status_adv'], 'string', 'max' => 15],
            [['source_ip'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exp_id' => 'Entry No.',
            'dep_id' => 'Department',
            'year' => 'Year',
            'bh_name' => 'Budget Head',
            'amount' => 'Amount',
            'drawn_on' => 'Drawn On',
	    'settled_on' => 'Settled On',
            'status_adv' => 'Status',
            'timestamp' => 'Timestamp',
            'source_ip' => 'Source Ip',
            'user_id' => 'User ID',
        ];
    }
}
