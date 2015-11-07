<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SliderImage;

/**
 * SliderImageSearch represents the model behind the search form about `common\models\SliderImage`.
 */
class SliderImageSearch extends SliderImage
{
    public function rules()
    {
        return [
            [['id', 'publish_flag', 'slider'], 'integer'],
            [['href', 'body', 'created_date', 'banner_image', 'banner_phone_image', 'banner_tablet_image', 'menu_image', 'href_enabled_flag', 'iframe_href'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SliderImage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'publish_flag' => $this->publish_flag,
            'slider' => $this->slider,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'banner_image', $this->banner_image])
            ->andFilterWhere(['like', 'banner_phone_image', $this->banner_phone_image])
            ->andFilterWhere(['like', 'banner_tablet_image', $this->banner_tablet_image])
            ->andFilterWhere(['like', 'menu_image', $this->menu_image])
            ->andFilterWhere(['like', 'href_enabled_flag', $this->href_enabled_flag])
            ->andFilterWhere(['like', 'iframe_href', $this->iframe_href]);

        return $dataProvider;
    }
}
