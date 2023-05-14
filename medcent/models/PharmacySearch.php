<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pharmacy;

/**
 * PharmacySearch represents the model behind the search form of `app\models\Pharmacy`.
 */
class PharmacySearch extends Pharmacy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'STOCK', 'SUPPLIER_ID'], 'integer'],
            [['DRUG', 'NEED_RECIPE'], 'safe'],
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
        $query = Pharmacy::find();

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
            'PRICE' => $this->PRICE,
            'STOCK' => $this->STOCK,
            'SUPPLIER_ID' => $this->SUPPLIER_ID,
        ]);

        $query->andFilterWhere(['like', 'DRUG', $this->DRUG])
            ->andFilterWhere(['like', 'NEED_RECIPE', $this->NEED_RECIPE]);

        return $dataProvider;
    }
}
