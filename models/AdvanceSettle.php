<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advance_settle".
 *
 * @property integer $id
 * @property integer $ocr_no
 * @property string $bill_no
 * @property string $bill_diary
 * @property string $bill_date
 * @property string $bill_amount
 * @property string $vendor_details
 *
 * @property ExpenditureTbl $ocrNo
 */
class AdvanceSettle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advance_settle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ocr_no'], 'integer'],
            [['vendor_details'], 'string'],
            [['bill_no', 'bill_diary'], 'string', 'max' => 50],
            [['bill_date'], 'string', 'max' => 15],
            [['bill_amount'], 'string', 'max' => 20],
            [['remarks'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ocr_no' => 'Ocr No',
            'bill_no' => 'Bill No',
            'bill_diary' => 'Bill Diary',
            'bill_date' => 'Bill Date',
            'bill_amount' => 'Bill Amount',
            'vendor_details' => 'Vendor Details',
            'remarks' => 'Remarks'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcrNo()
    {
        return $this->hasOne(ExpenditureTbl::className(), ['id' => 'ocr_no']);
    }
}
