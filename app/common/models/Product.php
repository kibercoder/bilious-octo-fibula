<?php

namespace common\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $id
 * @property string $title
 * @property string $keywords
 * @property string $intro
 * @property string $body
 * @property string $body_buy
 * @property string $icon_image
 * @property string $main_image
 * @property integer $price_discount
 * @property integer $price
 * @property string $results
 * @property string $group_services
 * @property string $orientation
 * @property string $tags
 * @property string $recommend
 * @property string $prepare
 * @property string $notes
 * @property integer $organization_id
 * @property integer $type_id
 * @property integer $priority

 *
 * @property ProductType $type
 * @property Organization $organization
 * @property ServiceProduct[] $serviceProducts
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_full', 'intro', 'body', 'type_id', 'price', 'agreement_id'], 'required'],
            [['intro', 'body', 'body_buy', 'results', 'recommend', 'prepare'], 'string'],
            [['price_discount', 'price', 'organization_id', 'specialist_id', 'type_id', 'priority', 'agreement_id'], 'integer'],
            [['title', 'title_full', 'title_mid', 'keywords', 'group_services', 'orientation', 'tags', 'notes'], 'string', 'max' => 255],
            [['icon_image', 'main_image'], 'string']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название продукта'),
            'title_mid' => Yii::t('app', 'Заголовок title_mid'),
            'title_full' => Yii::t('app', 'Полное название продукта'),
            'keywords' => Yii::t('app', 'Ключевые слова'),
            'intro' => Yii::t('app', 'Краткое описание (страница продукта)'),
            'body' => Yii::t('app', 'Полное описание (страница продукта)'),
            'body_buy' => Yii::t('app', 'Полное описание (страница покупки)'),
            'icon_image' => Yii::t('app', 'Иконка продукта'),
            'main_image' => Yii::t('app', 'Картинка продукта'),
            'price_discount' => Yii::t('app', 'Цена со скидкой'),
            'price' => Yii::t('app', 'Цена'),
            'results' => Yii::t('app', 'Результаты посещения'),
            'group_services' => Yii::t('app', 'Группа услуг'),
            'orientation' => Yii::t('app', 'Направленность'),
            'tags' => Yii::t('app', 'Теги для поиска'),
            'recommend' => Yii::t('app', 'Рекомендации при посещении'),
            'prepare' => Yii::t('app', 'Подготовка перед посещением'),
            'notes' => Yii::t('app', 'Особые отметки'),
            'organization_id' => Yii::t('app', 'Организация'),
            'specialist_id' => Yii::t('app', 'Специалист'),
            'type_id' => Yii::t('app', 'Тип продукта'),
            'priority' => Yii::t('app', 'Приоритет (для баннеров)'),
            'agreement_id' => Yii::t('app', 'Договор'),
        ];
    }

    /**
     * Получаем специалиста (доктора)
     */
    public function getSpecialist()
    {
        return $this->hasOne(Specialist::className(), ['id' => 'specialist_id']);
    }

    /**
     * Получаем тип
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'type_id']);
    }

    /**
     * Получаем организацию
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * Получаем договор
     */
    public function getAgreement()
    {
        return $this->hasOne(Agreement::className(), ['id' => 'agreement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceProducts()
    {
        return $this->hasMany(ServiceProduct::className(), ['product_id' => 'id']);
    }
    
    /**
     * Извлекаем список профессий специалистов
     */
    public function getSpecType()
    {
       $query = $this->hasMany(SpecialistType::className(), ['id' => 'spec_type_id'])->viaTable('tbl_specialist_has_type', ['spec_id' => 'specialist_id']);
       
       if (is_numeric(Yii::$app->request->get('spec_type'))) 
          $query->where(['tbl_specialist_type.id' => (int)Yii::$app->request->get('spec_type')]);
       return $query;
    }
    
    /**
     * Извлекаем список заболеваний для типов продуктов
     */
    public function getDiagnos()
    {
       $query = $this->hasMany(Diagnos::className(), ['id' => 'diagnos_id'])->viaTable('tbl_product_type_has_diagnos', ['product_type_id' => 'type_id']);
       
       if (is_numeric(Yii::$app->request->get('diagnos'))) 
          $query->where(['tbl_diagnos.id' => (int)Yii::$app->request->get('diagnos')]);
       return $query;
    }
    
    /**
     * Извлекаем список продуктов
     */
    public static function loadList($select = '*', $where = [], $order = null, $limit = null){

        $all = self::find()
            ->select($select)
            ->with('organization')
            ->with('type')
            ->with('specialist')
            ->where($where)
            ->limit($limit)
            ->orderBy($order)
            ->asArray()
            ->all();

        self::format($all);

        return $all;
    }

    /**
     * Получаем новые поля price_format и price_discount_format в виде number_format
     */
    public static function format(&$list){
        foreach($list as $index => $item) {
            $list[$index]['price_format'] = self::priceFormat($item['price']);
            $list[$index]['price_discount_format'] = self::priceFormat($item['price_discount']);
        }
    }

    public static function priceFormat($price){
        return number_format($price, 0, ' ',' ');
    }

    /**
     * Получаем случайные записи модели
     */
    public static function getRandom($limit = 1, $where = []) {

       $rand = self::find()->select('*')
                    ->with('organization')
                    ->with('type')
                    ->with('specialist')
                    ->where($where)
                    ->orderBy(new Expression('rand()'))->limit($limit)->asArray()->all();
       self::format($rand);
       return $rand;

    }


}
