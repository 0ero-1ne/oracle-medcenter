<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Patients;

/**
 * PatientsSearch represents the model behind the search form of `app\models\Patients`.
 */
class PatientsSearch extends Patients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'AUTH_DATA', 'PERSON_ID'], 'integer'],
            [['PHONE'], 'safe'],
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
        $query = Patients::find();

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
            'AUTH_DATA' => $this->AUTH_DATA,
            'PERSON_ID' => $this->PERSON_ID,
        ]);

        $query->andFilterWhere(['like', 'PHONE', $this->PHONE]);

        return $dataProvider;
    }
}
