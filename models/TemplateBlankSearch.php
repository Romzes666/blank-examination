<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TemplateBlank;

/**
 * TemplateBlankSearch represents the model behind the search form of `app\models\TemplateBlank`.
 */
class TemplateBlankSearch extends TemplateBlank
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tb', 'input_count', 'class_templ'], 'integer'],
            [['type_blank', 'image_name', 'type_test'], 'safe'],
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
        $query = TemplateBlank::find();

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
            'id_tb' => $this->id_tb,
            'input_count' => $this->input_count,
            'class_templ' => $this->class_templ,
        ]);

        $query->andFilterWhere(['like', 'type_blank', $this->type_blank])
            ->andFilterWhere(['like', 'image_name', $this->image_name])
            ->andFilterWhere(['like', 'type_test', $this->type_test]);

        return $dataProvider;
    }
}
