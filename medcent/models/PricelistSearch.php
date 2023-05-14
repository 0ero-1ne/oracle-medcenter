<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pricelist;

/**
 * PricelistSearch represents the model behind the search form of `app\models\Pricelist`.
 */
class PricelistSearch extends Pricelist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'POSITION_ID'], 'integer'],
            [['SERVICE'], 'safe'],
            [['PRICE'], 'number'],
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
        $query = Pricelist::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'POSITION_ID' => $this->POSITION_ID,
            'PRICE' => $this->PRICE,
        ]);

        $query->andFilterWhere(['like', 'SERVICE', $this->SERVICE]);

        return $dataProvider;
    }
}
