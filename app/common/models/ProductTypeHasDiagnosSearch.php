<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductTypeHasDiagnos;

/**
 * ProductTypeHasDiagnosSearch represents the model behind the search form about `common\models\ProductTypeHasDiagnos`.
 */
class ProductTypeHasDiagnosSearch extends ProductTypeHasDiagnos
{
    public function rules()
    {
        return [
            [['diagnos_id', 'product_type_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ProductTypeHasDiagnos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'diagnos_id' => $this->diagnos_id,
            'product_type_id' => $this->product_type_id,
        ]);

        return $dataProvider;
    }
}
