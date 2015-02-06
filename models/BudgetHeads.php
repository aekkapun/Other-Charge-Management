<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "budget_heads".
 *
 * @property integer $id
 * @property string $bh_name
 * @property string $bh_description
 * @property string $source_ip
 * @property integer $user_id
 * @property string $timestamp
 */
class BudgetHeads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget_heads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bh_name'], 'required'],
            [['bh_description'], 'string'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['bh_name', 'source_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bh_name' => 'Budget head ',
            'bh_description' => 'Description',
            'source_ip' => 'Source Ip',
            'user_id' => 'User ID',
            'timestamp' => 'Timestamp',
        ];
    }
}
