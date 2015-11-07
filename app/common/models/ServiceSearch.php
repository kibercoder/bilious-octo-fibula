<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `common\models\Service`.
 */
class ServiceSearch extends Service
{
    public function rules()
    {
        return [
            [['id', 'type_id', 'organization_id', 'price'], 'integer'],
            [['title', 'keywords', 'intro', 'body', 'code'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Service::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'organization_id' => $this->organization_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
