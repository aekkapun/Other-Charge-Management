<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms".
 *
 * @property integer $id
 * @property string $heading
 * @property string $msg
 * @property string $status
 * @property string $tag
 * @property string $file
 */
class Cms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['heading', 'status', 'tag'], 'required'],
            [['msg'], 'string'],
            [['heading'], 'string', 'max' => 100],
            [['status', 'tag'], 'string', 'max' => 20],
            [['file'], 'file', 'extensions' => 'doc, txt, docx, pdf', 'skipOnEmpty'=>true],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'heading' => 'Heading',
            'msg' => 'Msg',
            'status' => 'Status',
            'tag' => 'Tag',
            'file' => 'File',
        ];
    }
}
