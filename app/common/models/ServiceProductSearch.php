<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceProduct;

/**
 * ServiceProductSearch represents the model behind the search form about `common\models\ServiceProduct`.
 */
class ServiceProductSearch extends ServiceProduct
{
    public function rules()
    {
        return [
            [['id', 'product_id', 'service_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ServiceProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'service_id' => $this->service_id,
        ]);

        return $dataProvider;
    }
}
