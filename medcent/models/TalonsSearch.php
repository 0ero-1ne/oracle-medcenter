<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Talons;

/**
 * TalonsSearch represents the model behind the search form of `app\models\Talons`.
 */
class TalonsSearch extends Talons
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'EMPLOYEE_ID', 'PATIENT_ID'], 'integer'],
            [['TALON_DATE'], 'safe'],
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
        $query = Talons::find();

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
            'EMPLOYEE_ID' => $this->EMPLOYEE_ID,
            'PATIENT_ID' => $this->PATIENT_ID,
        ]);

        $query->andFilterWhere(['like', 'TALON_DATE', $this->TALON_DATE]);

        return $dataProvider;
    }
}
