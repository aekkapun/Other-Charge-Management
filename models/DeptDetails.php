<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dept_details".
 *
 * @property integer $id
 * @property integer $dept_id
 * @property string $dep_name
 * @property string $dep_email
 * @property string $dep_phone
 * @property string $dep_ext
 * @property string $dep_fax
 * @property string $dep_hod
 * @property string $profile
 * @property string $dep_address_line1
 * @property string $dep_city
 * @property string $dep_pin
 * @property string $dep_state
 * @property string $dep_year
 * @property string $dep_hod_photo
 * @property string $dep_logo
 * @property string $dep_website
 * @property string $dep_bulletin
 * @property string $ip
 * @property string $timestamp
 *
 * @property Budget[] $budgets
 * @property BudgetHeadStatus[] $budgetHeadStatuses
 * @property User $dept
 * @property ExpenditureTbl[] $expenditureTbls
 * @property FinancialYearTbl[] $financialYearTbls
 * @property OcrEntry[] $ocrEntries
 */
class DeptDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dept_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_name'], 'required'],
            [['dept_id'], 'integer'],
            [['profile'], 'string'],
            [['timestamp'], 'safe'],
            [['dep_name'], 'string', 'max' => 100],
            [['dep_email'], 'string', 'max' => 80],
            [['dep_phone', 'dep_ext'], 'number', 'min' => 20],
           /* 'match', 'pattern'=>'/^[0-9]{5,20}$/',
            'message'=>'Numbers only.'],*/
            [['dep_fax'], 'number', 'min' => 30],
           /* 'match', 'pattern'=>'/^[0-9]{5,30}$/',
            'message'=>'Numbers only.'],*/
            [['dep_hod', 'dep_city', 'dep_website', 'ip'], 'string', 'max' => 50],
            [['dep_address_line1'], 'string', 'max' => 255],
            [['dep_pin'],/* 'number', 'max' => 10],*/
            'match', 'pattern'=>'/^[0-9]{6}$/',
            'message'=>'Wrong Pin'],
            [['dep_year'],/*'string', 'max' => 10],*/
             'match', 'pattern'=>'/^[0-9]{4,10}$/',
             'message'=>'Numbers only.'],  
            [['dep_state'], 'string', 'max' => 25],
            [['dep_hod_photo', 'dep_logo', ],'file','extensions' => 'jpg,jpeg,png', 'mimeTypes' => 'image/jpeg,image/jpg,image/png',],
            [['dep_bulletin'],'file','extensions' => 'pdf,doc,txt,']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept_id' => 'Dept ID',
            'dep_name' => 'Department Name',
            'dep_email' => 'Dep Email',
            'dep_phone' => 'Contact No.',
            'dep_ext' => 'Extension No.',
            'dep_fax' => 'Fax No.',
            'dep_hod' => 'Dep Hod',
            'profile' => 'Profile',
            'dep_address_line1' => 'Dep Address Line1',
            'dep_city' => 'Dep City',
            'dep_pin' => 'Pin Code',
            'dep_state' => 'Dep State',
            'dep_year' => 'Year of Establishment',
            'dep_hod_photo' => 'Dep Hod Photo',
            'dep_logo' => 'Dep Logo',
            'dep_website' => 'Department Website',
            'dep_bulletin' => 'Dep Bulletin',
            'ip' => 'Ip',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgets()
    {
        return $this->hasMany(Budget::className(), ['dep_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetHeadStatuses()
    {
        return $this->hasMany(BudgetHeadStatus::className(), ['dep_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(User::className(), ['id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureTbls()
    {
        return $this->hasMany(ExpenditureTbl::className(), ['dep_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialYearTbls()
    {
        return $this->hasMany(FinancialYearTbl::className(), ['dep_id' => 'dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcrEntries()
    {
        return $this->hasMany(OcrEntry::className(), ['dep_id' => 'dept_id']);
    }
}
