<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubjectBlanks;

/**
 * SubjectBlankSearch represents the model behind the search form of `app\models\SubjectBlanks`.
 */
class SubjectBlankSearch extends SubjectBlanks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sb', 'id_subject', 'id_templateblank'], 'integer'],
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
    public function search($params, $id)
    {
        $query = SubjectBlanks::find()->where(['id_subject' => $id]);

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
            'id_sb' => $this->id_sb,
            'id_subject' => $this->id_subject,
            'id_templateblank' => $this->id_templateblank,
        ]);

        return $dataProvider;
    }
}
