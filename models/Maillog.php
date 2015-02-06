<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maillog".
 *
 * @property integer $id
 * @property string $to
 * @property string $sub
 * @property string $msg
 * @property string $timestamp
 */
class Maillog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maillog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to', 'sub', 'msg'], 'required'],
            [['msg'], 'string'],
            [['timestamp'], 'safe'],
            [['to', 'sub'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to' => 'To',
            'sub' => 'Sub',
            'msg' => 'Msg',
            'timestamp' => 'Timestamp',
        ];
    }
}
