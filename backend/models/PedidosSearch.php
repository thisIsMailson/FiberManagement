<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pedidos;
use backend\models\PedidoZonas;
use backend\models\Zonas;
use backend\models\Clientes;
use backend\models\UserRegioes;

/**
 * PedidosSearch represents the model behind the search form of `backend\models\Pedidos`.
 */
class PedidosSearch extends Pedidos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ref_geog_latitude', 'ref_geog_longitude', 'status_id_status', 'user_id_user', 'projetos_id_projeto', 'clientes_id_cliente', 'zonas_id_zona'], 'integer'],
            [['cod_pedido', 'acao', 'morada_complementar', 'data_rececao', 'data_estado', 'data_conclusao_pedido', 'data_validacao', 'canal_pedido', 'observacao', 'anexo'], 'safe'],
            [['oferta_antiga', 'oferta_nova'], 'number'],
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
    public function search_($params, $tableId, $id)
    {   
        if ($id != null) {
            switch ($tableId) {
                case 1:
                    $query = Pedidos::find()
                    ->where(['clientes_id_cliente'=> $id]);
                    break;
                
                case 2:
                    $query = Pedidos::find()
                    ->where(['clientes_id_cliente'=> $id]);
                    break;
                
                case 3:
                    $query = Pedidos::find()
                    ->innerJoin('clientes', 'pedidos.clientes_id_cliente = clientes.id_cliente AND clientes.tipo_cliente = '. $id);
                    break;
                
                case 4:
                    $query = Pedidos::find()
                    ->where(['zonas_id_zona'=> $id]);
                    break;
                    break;

                case 5:
                    $query = Pedidos::find()
                    ->where(['id'=> $id]);
                    break;

                case 6:
                    $query = Pedidos::find()
                    ->innerJoin('status_pedido_projetos', 'pedidos.status_id_status = status_pedido_projetos.id_status AND status_pedido_projetos.id_status = '. $id);
                    break;
                
                default:
                    # code...
                    break;
            } 
        
        } else {

            $userLoged = \Yii::$app->user->identity;
            $userRegioes = UserRegioes::find()
            ->where(['user_id_user'=> $userLoged->id])->all();
            if ($userRegioes->count() < 1) {
                    $query = [];
                }
            foreach ($userRegioes as $value) {
                $zonas = Zonas::find()
                ->where(['regiao_id_regiao'=>$value->regiao_id_regiao ])->all();
                
                foreach ($zonas as $zona) {
                    $query = Pedidos::find()->
                    where(['zonas_id_zona'=>$zona->id_zona]);
                }
            }

        }

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
            'oferta_antiga' => $this->oferta_antiga,
            'oferta_nova' => $this->oferta_nova,
            'data_rececao' => $this->data_rececao,
            'data_estado' => $this->data_estado,
            'data_conclusao_pedido' => $this->data_conclusao_pedido,
            'ref_geog_latitude' => $this->ref_geog_latitude,
            'ref_geog_longitude' => $this->ref_geog_longitude,
            'status_id_status' => $this->status_id_status,
            'user_id_user' => $this->user_id_user,
            'projetos_id_projeto' => $this->projetos_id_projeto,
            'clientes_id_cliente' => $this->clientes_id_cliente,
            'zonas_id_zona' => $this->zonas_id_zona,
        ]);

        $query->andFilterWhere(['like', 'cod_pedido', $this->cod_pedido])
            ->andFilterWhere(['like', 'acao', $this->acao])
            ->andFilterWhere(['like', 'morada_complementar', $this->morada_complementar])
            ->andFilterWhere(['like', 'canal_pedido', $this->canal_pedido])
            ->andFilterWhere(['like', 'observacao', $this->observacao])
            ->andFilterWhere(['like', 'anexo', $this->anexo]);

        return $dataProvider;
    }
    public function search($params, $pedidosType)
    {   

        $userLoged = \Yii::$app->user->identity;
        $userRole = $userLoged->role_id;
        $userCoordination = $userLoged->coordenacao_id;

        if ($pedidosType == 2) { // 2 para mostrar peidods por validar
            if ($userCoordination === 3) {
                
                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                ->where('status_id_status = 1'),
                ]);

            } else {

                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                 ->innerJoin('zonas', 'pedidos.zonas_id_zona = zonas.id_zona')
                 ->innerJoin('regioes', 'zonas.regiao_id_regiao = regioes.id_regiao')
                 ->innerJoin('coordenacoes', 'regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND coordenacoes.id_coordenacao = '.$userCoordination)
                 ->where('status_id_status = 1'),
                ]);
            }

        } else if ($pedidosType == 3) { // 2 para mostrar peidods por validar
            if ($userCoordination === 3) {
                
                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                ->where('status_id_status = 3'), // Sem disponibilidade
                ]);

            } else {

                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                 ->innerJoin('zonas', 'pedidos.zonas_id_zona = zonas.id_zona')
                 ->innerJoin('regioes', 'zonas.regiao_id_regiao = regioes.id_regiao')
                 ->innerJoin('coordenacoes', 'regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND coordenacoes.id_coordenacao = '.$userCoordination)
                 ->where('status_id_status = 3'), // Sem disponibilidade
                ]);
            }

        } elseif ($pedidosType == 4) {
            if ($userCoordination === 3) {
                
                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                ->where('status_id_status = 13'), // Sem disponibilidade
                ]);

            } else {

                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                 ->innerJoin('zonas', 'pedidos.zonas_id_zona = zonas.id_zona')
                 ->innerJoin('regioes', 'zonas.regiao_id_regiao = regioes.id_regiao')
                 ->innerJoin('coordenacoes', 'regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND coordenacoes.id_coordenacao = '.$userCoordination)
                 ->where('status_id_status = 13'), // Sem disponibilidade
                ]);
            }
        } else {

            if($userRole == 3) { // Pegar perfil de DOM
                $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find()
                 ->innerJoin('zonas', 'pedidos.zonas_id_zona = zonas.id_zona')
                 ->innerJoin('regioes', 'zonas.regiao_id_regiao = regioes.id_regiao')
                 ->innerJoin('user_regioes', 'regioes.id_regiao = user_regioes.regiao_id_regiao AND user_regioes.user_id_user = '.$userLoged->id),
                ]);
            } else if ($userCoordination == 3) { // Pegar a coordenacao geral
                 $dataProvider = new ActiveDataProvider([
                'query' => Pedidos::find(),
                ]);
            } else { // Senão mostrar pedidos das zonas relacionadas as regioes da coordenação do utilizador
                $dataProvider = new ActiveDataProvider([
                    'query' => Pedidos::find()
                     ->innerJoin('zonas', 'pedidos.zonas_id_zona = zonas.id_zona')
                     ->innerJoin('regioes', 'zonas.regiao_id_regiao = regioes.id_regiao')
                     ->innerJoin('coordenacoes', 'regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND coordenacoes.id_coordenacao = '.$userCoordination),
                ]);
            }
            
        }
         

        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        return $dataProvider;
    }
}
