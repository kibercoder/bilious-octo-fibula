<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Recommend;

/**
 * RecommendSearch represents the model behind the search form about `common\models\Recommend`.
 */
class RecommendSearch extends Recommend
{
    public function rules()
    {
        return [
            [['id', 'list_order'], 'integer'],
            [['name', 'intro', 'body', 'profession', 'photo_image'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Recommend::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'list_order' => $this->list_order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'photo_image', $this->photo_image]);

        return $dataProvider;
    }
}
