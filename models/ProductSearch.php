<?php

namespace sielavic\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use sielavic\product\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'text', 'url', 'status_id', 'sort'], 'integer'],
            [['book', 'title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->sort->attributes ['id'] = [
        'asc'=> ['id'=>SORT_ASC],
        'desc'=>['id'=>SORT_DESC],
        'default' => 'DESC',
        ];
        
        $dataProvider->sort->defaultOrder['id'] = SORT_DESC;
     
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'text' => $this->text,
            'url' => $this->url,
            'status_id' => $this->status_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'book', $this->book])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
