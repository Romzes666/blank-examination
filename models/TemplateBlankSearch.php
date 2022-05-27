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
    public $name;
    public $st;
    public function rules()
    {
        return [
            [['id', 'id_subject', 'input_count'], 'integer'],
            [['name','type', 'image_name'], 'safe'],
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

        $query->joinWith(['subject']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['subject.type'] = [
            'asc' => ['subject.type' => SORT_ASC],
            'desc' => ['subject.type' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_subject' => $this->id_subject,
            'input_count' => $this->input_count,
        ]);

        $query->andFilterWhere(['like', 'template_blank.type', $this->type])
            ->andFilterWhere(['like', 'image_name', $this->image_name])
        ->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'subject.type', $this->st]);
        return $dataProvider;
    }
}
