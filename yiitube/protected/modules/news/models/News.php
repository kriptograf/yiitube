<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id_news
 * @property string $title
 * @property string $alias
 * @property string $tags
 * @property string $image
 * @property string $content
 * @property integer $status
 * @property integer $IsFeatured
 * @property string $CreatedDate
 * @property string $UpdatedDate
 * @property integer $user_id
 * @property integer $Views
 * @property integer $Useful
 * @property integer $Unuseful
 *
 * The followings are the available model relations:
 * @property Cities $idCity
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('CreatedDate, UpdatedDate, IsFeatured, image, Views, Useful, Unuseful, tags', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_news, title, alias, tags, content, status, IsFeatured, CreatedDate, UpdatedDate, user_id, Views, Useful, Unuseful', 'safe', 'on'=>'search'),
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
			'id_news' => 'ID',
			'title' => 'Заголовок',
			'alias' => 'SEO url',
			'tags' => 'Тег',
                        'image'=>'Изображение',
			'content' => 'Текст',
			'status' => 'Опубликована',
			'IsFeatured' => 'Показывать на главной',
			'CreatedDate' => 'Дата публикации',
			'UpdatedDate' => 'Дата изменения',
			'user_id' => 'Автор',
			'Views' => 'Просмотров',
			'Useful' => 'Таймаут',
			'Unuseful' => 'Unuseful',
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

                //$criteria->with = 'idCity';

		$criteria->compare('id_news',$this->id_news);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('tags',$this->tags,true);
                $criteria->compare('image',$this->image,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('IsFeatured',$this->IsFeatured);
		$criteria->compare('CreatedDate',$this->CreatedDate,true);
		$criteria->compare('UpdatedDate',$this->UpdatedDate,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('Views',$this->Views);
		$criteria->compare('Useful',$this->Useful);
		$criteria->compare('Unuseful',$this->Unuseful);

        $sort = new CSort();

        $sort->attributes['id_news'] = array(
            // добавляем сортировку по postTitle
            'asc' => 'id_news',
            'desc' => 'id_news desc',
        );
        $sort->attributes['title'] = array(
            // добавляем сортировку по postTitle
            'asc' => 'title',
            'desc' => 'title desc',
        );
        $sort->attributes['alias'] = array(
            // добавляем сортировку по postTitle
            'asc' => 'alias',
            'desc' => 'alias desc',
        );
        $sort->attributes['UpdatedDate'] = array(
            // добавляем сортировку по postTitle
            'asc' => 'UpdatedDate',
            'desc' => 'UpdatedDate desc',
        );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
                    ));
	}

    /**
     * Получить алиас для ЧПУ из заголовка
     * @param type $title
     * @return type
     */
    public function getSlug($title)
    {
        $result = str_replace(' ', '-', $title);
        $result = mb_strtolower($result, 'utf-8');
        return $this->translitIt($result);
    }

    /**
     * Транслитерация символов
     * @param type $str
     * @return type
     */
    public function translitIt($str)
    {
        $tr = array(
            "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya"
        );
        return strtr($str, $tr);
    }


    /*public function beforeValidate()
    {
        $this->user_id = Yii::app()->user->id;
        $this->tags = '';
        $this->image = '';
        if($this->isNewRecord)
        {
            $this->CreatedDate = date('Y-m-d', time());
            $this->IsFeatured = 0;
            $this->Views = 0;
            $this->Useful = 0;
            $this->Unuseful = 0;
        }
        $this->UpdatedDate = date('Y-m-d', time());
        $this->alias = $this->getSlug($this->title);

        parent::beforeValidate();
    } */

    public function beforeSave()
    {
        if(parent::beforeSave())
        {
            $this->user_id = Yii::app()->user->id;

            //echo CVarDumper::dump($_FILES,10,true);exit;

            if(!empty($_FILES) && !isset($_POST['image']))
            {
                $this->saveImages();
            }
            if($this->isNewRecord)
            {
                $this->CreatedDate = $this->UpdatedDate = date('Y-m-d H:i:s', time());
                $this->Views = 0;
                $this->Useful = 0;
                $this->Unuseful = 0;
                $this->alias = $this->getSlug($this->title);
            }
            else
            {
                $this->UpdatedDate = date('Y-m-d H:i:s', time());
            }
            return true;
        }
        else
            return false;
    }

    public function saveImages()
    {

        $image = CUploadedFile::getInstance($this, 'image');

        if(!$image)
        {
            echo 'Ошибка сохранения изображений. Нет загруженной картинки.';exit;
        }
        $folder = 'content/news';
        $image->saveAs($folder . '/' . $image);

        //Если изображение сохранено в указанной директории
        //Обрабатываем его, создаем эскизы(небольшие изображения)
        //Создаем экземпляр класса Image(расширение) и передаем ему имя файла для обработки
        $thumbs = Yii::app()->image->load(Yii::getPathOfAlias('webroot') . '/content/news/' . $image);
        //Изменяем размер исходного изображения
        $thumbs->resize(80, 80);
        //Сохраняем изображение с новым именем в новую директорию
        $thumbs->save(Yii::getPathOfAlias('webroot') . '/content/news/thumbs/' . $image);
        $this->image = $image;
    }

    public static function crop_news($string, $limit)
    {

        if (strlen($string) >= $limit )
        {
            $substring_limited = substr($string,0, $limit);
            return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));
        }
        else
        {
            //Если количество символов строки меньше чем задано, то просто возращаем оригинал
            return $string;
        }
    }
}