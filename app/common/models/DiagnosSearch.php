<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Diagnos;

/**
 * DiagnosSearch represents the model behind the search form about `common\models\Diagnos`.
 */
class DiagnosSearch extends Diagnos
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'body', 'intro'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Diagnos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'intro', $this->intro]);

        return $dataProvider;
    }
}
