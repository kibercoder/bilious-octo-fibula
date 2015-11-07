<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $image_file
 * @property integer $user_id
 * @property string $datetime_create
 * @property string $description
 * @property integer $is_publish
 * @property integer $category_id
 *
 * @property User $user
 * @property PostCategory $category
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'user_id', 'datetime_create', 'category_id'], 'required'],
            [['user_id', 'is_publish', 'category_id'], 'integer'],
            [['datetime_create'], 'safe'],
            [['title', 'body', 'image_file', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'image_file' => 'Image File',
            'user_id' => 'User ID',
            'datetime_create' => 'Datetime Create',
            'description' => 'Description',
            'is_publish' => 'Is Publish',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }
}
