<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%slider_image}}".
 *
 * @property integer $id
 * @property integer $publish_flag
 * @property string $href
 * @property string $body
 * @property integer $slider
 * @property string $created_date
 * @property string $banner_image
 * @property string $banner_phone_image
 * @property string $banner_tablet_image
 * @property string $menu_image
 * @property string $href_enabled_flag
 * @property string $iframe_href
 */
class SliderImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publish_flag', 'slider'], 'integer'],
            [['href', 'body', 'menu_image', 'href_enabled_flag'], 'required'],
            [['body'], 'string'],
            [['created_date'], 'safe'],
            [['href', 'href_enabled_flag', 'iframe_href'], 'string', 'max' => 255],
            [['banner_image', 'banner_phone_image', 'banner_tablet_image', 'menu_image'], 'file', 'extensions'=>'jpg, gif, png']
        ];
    }

    /**
     * See https://github.com/mongosoft/yii2-upload-behavior
     */
    public function behaviors()
    {
         return [
            'banner_image' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'banner_image',
                'scenarios' => ['default'], // !!!
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@uploadroot/sliderimage/banner_image/{id}',
                'url' => '@upload/sliderimage/banner_image/{id}',
                //'thumbs' => [
                //    'thumb' => ['width' => 400, 'quality' => 90],
                //    'preview' => ['width' => 200, 'height' => 200],
                //]
            ],
        'banner_phone_image' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'banner_phone_image',
                'scenarios' => ['default'], // !!!
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@uploadroot/sliderimage/banner_phone_image/{id}',
                'url' => '@upload/sliderimage/banner_phone_image/{id}',
                //'thumbs' => [
                //    'thumb' => ['width' => 400, 'quality' => 90],
                //    'preview' => ['width' => 200, 'height' => 200],
                //]
            ],
        'banner_tablet_image' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'banner_tablet_image',
                'scenarios' => ['default'], // !!!
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@uploadroot/sliderimage/banner_tablet_image/{id}',
                'url' => '@upload/sliderimage/banner_tablet_image/{id}',
                //'thumbs' => [
                //    'thumb' => ['width' => 400, 'quality' => 90],
                //    'preview' => ['width' => 200, 'height' => 200],
                //]
            ],
        'menu_image' => [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'menu_image',
                'scenarios' => ['default'], // !!!
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@uploadroot/sliderimage/menu_image/{id}',
                'url' => '@upload/sliderimage/menu_image/{id}',
                //'thumbs' => [
                //    'thumb' => ['width' => 400, 'quality' => 90],
                //    'preview' => ['width' => 200, 'height' => 200],
                //]
            ],
        ];
    }

    /**
     * Механизм Behavior, встроенный в Yii не позволяет задать
     * несколько одинаковых Behavior на разные поля и спользвать их
     * поэтому для некоторых компонентов прихдится дописывать заплатки
     */
    public function getUploadUrl($image){
        return $this->getBehavior($image)->getUploadUrl($image);
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publish_flag' => Yii::t('app', 'Опубликовано'),
            'href' => Yii::t('app', 'Ссылка'),
            'body' => Yii::t('app', 'Текст'),
            'slider' => Yii::t('app', 'Слайдер'),
            'created_date' => Yii::t('app', 'Время создания'),
            'banner_image' => Yii::t('app', 'Изображение'),
            'banner_phone_image' => Yii::t('app', 'Изображение для телефонов'),
            'banner_tablet_image' => Yii::t('app', 'Изображение для планшетов'),
            'menu_image' => Yii::t('app', 'Изобаржение в переключателе'),
            'href_enabled_flag' => Yii::t('app', 'Показывать кнопку перейти'),
            'iframe_href' => Yii::t('app', 'Ссылка на iframе(если указан изображения игнорируются)'),
        ];
    }
}
