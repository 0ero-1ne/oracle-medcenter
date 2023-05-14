<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Treatments;

/**
 * TreatmentsSearch represents the model behind the search form of `app\models\Treatments`.
 */
class TreatmentsSearch extends Treatments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'EMPLOYEE_ID', 'PATIENT_ID'], 'integer'],
            [['START_OF_TREATMENT', 'END_OF_TREATMENT', 'DIAGNOSIS', 'TREATMENT_INFO', 'RECOMMENDATIONS'], 'safe'],
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
        $query = Treatments::find();

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

        $query->andFilterWhere(['like', 'START_OF_TREATMENT', $this->START_OF_TREATMENT])
            ->andFilterWhere(['like', 'END_OF_TREATMENT', $this->END_OF_TREATMENT])
            ->andFilterWhere(['like', 'DIAGNOSIS', $this->DIAGNOSIS])
            ->andFilterWhere(['like', 'TREATMENT_INFO', $this->TREATMENT_INFO])
            ->andFilterWhere(['like', 'RECOMMENDATIONS', $this->RECOMMENDATIONS]);

        return $dataProvider;
    }
}
