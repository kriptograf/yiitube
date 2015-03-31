<?php

/**
 * This is the model class for table "likes".
 *
 * The followings are the available columns in table 'likes':
 * @property integer $id
 * @property string $user_id
 * @property integer $video_id
 * @property string $mind
 * @property string $time
 */
class Likes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Likes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'likes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, video_id, mind', 'required'),
			array('video_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>127),
			array('mind', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, video_id, mind, time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'video_id' => 'Video',
			'mind' => 'Mind',
			'time' => 'Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('video_id',$this->video_id);
		$criteria->compare('mind',$this->mind,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function likesForVideo($video_id, $mind)
	{
		$likes = Yii::app()->db->createCommand()
			->select('count(*)')
			->from('likes')
			->where('video_id='.$video_id.' and mind=\''.$mind.'\'')
			->queryScalar();
		if (!empty($likes[0]))
			return $likes[0];
		else
			return 0;	
	}

	public function usersOpinion($video_id, $user_id)
	{
		$likes = Yii::app()->db->createCommand()
			->select('mind')
			->from('likes')
			->where(array('and', 'video_id='.$video_id, 'user_id=\''.$user_id.'\''))
			->queryRow();
		if (!empty($likes[0]))
			return $likes[0];
		else
			return 0;	
	}
}