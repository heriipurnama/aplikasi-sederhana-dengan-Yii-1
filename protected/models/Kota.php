<?php

/**
 * This is the model class for table "kota".
 *
 * The followings are the available columns in table 'kota':
 * @property integer $id
 * @property integer $provinsi_id
 * @property string $nm_kota
 *
 * The followings are the available model relations:
 * @property Provinsi $provinsi
 */
class Kota extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kota';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provinsi_id', 'required'),
			array('provinsi_id', 'numerical', 'integerOnly'=>true),
			array('nm_kota', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provinsi_id, nm_kota', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'provinsi' => array(self::BELONGS_TO, 'Provinsi', 'provinsi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'provinsi_id' => 'Provinsi',
			'nm_kota' => 'Nm Kota',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('provinsi_id',$this->provinsi_id);
		$criteria->compare('nm_kota',$this->nm_kota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kota the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
