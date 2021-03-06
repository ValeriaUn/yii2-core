<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pages', 'amountEBook', 'amountPaperBook'], 'integer'],
            [['name', 'author', 'description', 'writtingDate', 'publicationDate', 'publisher', 'price', 'barCode', 'publicationDate', 'genre', 'language', 'city'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Book::find();

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
            'id' => $this->id,
            'pages' => $this->pages,
            'writtingDate' => $this->writtingDate,
            'publicationDate' => $this->publicationDate,
            'amountEBook' => $this->amountEBook,
            'amountPaperBook' => $this->amountPaperBook,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'barCode', $this->barCode])
            ->andFilterWhere(['like', 'genre', $this->genre])
            ->andFilterWhere(['like', 'language', $this->language]);
        return $dataProvider;
    }
}
