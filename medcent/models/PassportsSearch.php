<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Passports;

/**
 * PassportsSearch represents the model behind the search form of `app\models\Passports`.
 */
class PassportsSearch extends Passports
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['PASSPORT_NUMBER', 'DATE_OF_ISSUE', 'DATE_OF_EXPIRY', 'AUTHORITY'], 'safe'],
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
        $query = Passports::find();

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
        ]);

        $query->andFilterWhere(['like', 'PASSPORT_NUMBER', $this->PASSPORT_NUMBER])
            ->andFilterWhere(['like', 'DATE_OF_ISSUE', $this->DATE_OF_ISSUE])
            ->andFilterWhere(['like', 'DATE_OF_EXPIRY', $this->DATE_OF_EXPIRY])
            ->andFilterWhere(['like', 'AUTHORITY', $this->AUTHORITY]);

        return $dataProvider;
    }
}
