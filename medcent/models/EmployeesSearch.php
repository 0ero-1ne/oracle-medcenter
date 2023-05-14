<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employees;

/**
 * EmployeesSearch represents the model behind the search form of `app\models\Employees`.
 */
class EmployeesSearch extends Employees
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'AUTH_DATA', 'PERSON_ID', 'POSITION_ID'], 'integer'],
            [['HIRE_DATE', 'EDUCATION', 'PHONE', 'ON_VACATION'], 'safe'],
            [['SALARY'], 'number'],
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
        $query = Employees::find();

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
            'POSITION_ID' => $this->POSITION_ID,
            'SALARY' => $this->SALARY,
        ]);

        $query->andFilterWhere(['like', 'HIRE_DATE', $this->HIRE_DATE])
            ->andFilterWhere(['like', 'EDUCATION', $this->EDUCATION])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'ON_VACATION', $this->ON_VACATION]);

        return $dataProvider;
    }
}
