<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'state_index', 'main_flag', 'noforeign_id'], 'integer'],
            [['title', 'intro', 'body', 'created_datetime', 'start_time', 'start_date', 'preview_image', 'doc_file', 'my_image', 'contest_image', 'created_datetime'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'state_index' => $this->state_index,
            'main_flag' => $this->main_flag,
            'created_datetime' => $this->created_datetime,
            'start_date' => $this->start_date,
            'noforeign_id' => $this->noforeign_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'start_time', $this->start_time])
            ->andFilterWhere(['like', 'preview_image', $this->preview_image])
            ->andFilterWhere(['like', 'doc_file', $this->doc_file])
            ->andFilterWhere(['like', 'my_image', $this->my_image])
            ->andFilterWhere(['like', 'contest_image', $this->contest_image]);

        return $dataProvider;
    }
}
