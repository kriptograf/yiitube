<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $identity
 * @property string $network
 * @property string $email
 * @property string $full_name
 * @property integer $state
 */
class User extends CActiveRecord
{
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $verifyPassword;
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('username, password, email', 'required', 'on'=>'registration'),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => Yii::t('app',"Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('email', 'unique', 'message' => Yii::t('app',"This user's email address already exists.")),
			array('verifyPassword', 'compare', 'on'=>'registration', 'compareAttribute'=>'password', 'message' => Yii::t('app',"Retype Password is incorrect.") ),
			//array('identity, network', 'required'),
			array('identity, network, email', 'length', 'max'=>255),
			array('full_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, identity, network, email, full_name, state', 'safe', 'on'=>'search'),
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
        
        public function scopes()
        {
            return array(
                'active' => array(
                    'condition' => 'state=' . self::STATUS_ACTIVE,
                ),
                'notactive' => array(
                    'condition' => 'state=' . self::STATUS_NOACTIVE,
                ),
                'superuser' => array(
                    'condition' => 'superuser=1',
                ),
            );
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'username'=>'Логин',
                        'password'=>'Пароль',
                        'verifyPassword'=>'Повторите пароль',
			'identity' => 'Identity',
			'network' => 'Network',
			'email' => 'Email',
			'full_name' => 'Плоное имя',
                        'verifyCode'=>'Код подтверждения',
			'state' => 'State',
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
		$criteria->compare('identity',$this->identity,true);
		$criteria->compare('network',$this->network,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
}