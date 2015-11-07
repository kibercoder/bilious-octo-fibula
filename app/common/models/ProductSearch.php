<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['id', 'price_discount', 'price', 'organization_id', 'type_id'], 'integer'],
            [['title', 'keywords', 'intro', 'body', 'icon_image', 'main_image', 'results', 'group_services', 'orientation', 'tags', 'recommend', 'prepare', 'notes'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price_discount' => $this->price_discount,
            'price' => $this->price,
            'organization_id' => $this->organization_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'icon_image', $this->icon_image])
            ->andFilterWhere(['like', 'main_image', $this->main_image])
            ->andFilterWhere(['like', 'results', $this->results])
            ->andFilterWhere(['like', 'group_services', $this->group_services])
            ->andFilterWhere(['like', 'orientation', $this->orientation])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'recommend', $this->recommend])
            ->andFilterWhere(['like', 'prepare', $this->prepare])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
