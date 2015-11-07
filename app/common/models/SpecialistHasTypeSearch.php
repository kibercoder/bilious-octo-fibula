<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SpecialistHasType;

/**
 * SpecialistHasTypeSearch represents the model behind the search form about `common\models\SpecialistHasType`.
 */
class SpecialistHasTypeSearch extends SpecialistHasType
{
    public function rules()
    {
        return [
            [['spec_id', 'spec_type_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SpecialistHasType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'spec_id' => $this->spec_id,
            'spec_type_id' => $this->spec_type_id,
        ]);

        return $dataProvider;
    }
}
