<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $icon
 * @property integer $top
 * @property integer $parent_id
 */
class Categories extends CActiveRecord
{
    private $_url;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
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
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,description', 'required'),
			array('name', 'length', 'max'=>256),
			array('parent_id, top', 'numerical', 'integerOnly'=>true),
                        array('icon','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent_id', 'safe', 'on'=>'search'),
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
			'name' => 'Категория',
                        'description' => 'Описание',
                        'icon' => 'Изображение',
                        'top' => 'В топ-меню',
			'parent_id' => 'Parent',
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
		$criteria->compare('name',$this->name);
                $criteria->compare('top',$this->top);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {
            if(parent::beforeSave())
            {
                //echo CVarDumper::dump($_FILES,10,true);exit;

                if(!empty($_FILES) && !isset($_POST['icon']))
                {
                    $this->saveImages();
                }
                return true;
            }
            else
                return false;
        }

        public function saveImages()
        {

            $image = CUploadedFile::getInstance($this, 'icon');

            if(!$image)
            {
                echo 'Ошибка сохранения изображений. Нет загруженной картинки.';exit;
            }
            $folder = 'content/categories';
            $image->saveAs($folder . '/' . $image);

            //Если изображение сохранено в указанной директории
            //Обрабатываем его, создаем эскизы(небольшие изображения)
            //Создаем экземпляр класса Image(расширение) и передаем ему имя файла для обработки
            $thumbs = Yii::app()->image->load(Yii::getPathOfAlias('webroot') . '/content/categories/' . $image);
            //Изменяем размер исходного изображения
            $thumbs->resize(150, 150);
            //Сохраняем изображение с новым именем в новую директорию
            $thumbs->save(Yii::getPathOfAlias('webroot') . '/content/categories/' . $image);
            $this->icon = $image;
        }
        
        
 
        public function getUrl()
        {
            if ($this->_url === null)
                $this->_url = Yii::app()->createUrl('categories/view', array('id'=>$this->id));
            return $this->_url;
        }
}