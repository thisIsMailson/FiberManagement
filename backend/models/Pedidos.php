<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property string|null $cod_pedido
 * @property string $acao
 * @property string $morada_complementar
 * @property float $oferta_antiga
 * @property float $oferta_nova
 * @property string $data_rececao
 * @property string $data_envio_validacao
 * @property string $data_conclusao_pedido
 * @property string $data_validacao
 * @property string $canal_pedido
 * @property string $observacao
 * @property int $ref_geog_latitude
 * @property int $ref_geog_longitude
 * @property string $anexo
 * @property int $status_id_status
 * @property int $user_id_user
 * @property int|null $projetos_id_projeto
 * @property int $clientes_id_cliente
 * @property int $zonas_id_zona
 *
 * @property Encomendas[] $encomendas
 * @property HistoricoPedidos[] $historicoPedidos
 * @property Clientes $clientesIdCliente
 * @property User $userIdUser
 * @property Zonas $zonasIdZona
 * @property StatusPedidoProjetos $statusIdStatus
 * @property Projetos $projetosIdProjeto
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acao', 'morada_complementar', 'oferta_nova', 'data_rececao', 'canal_pedido', 'user_id_user', 'clientes_id_cliente', 'zonas_id_zona'], 'required'],
            [['oferta_antiga', 'oferta_nova'], 'string', 'max' => 100],
            [['data_rececao', 'data_envio_validacao', 'data_conclusao_pedido', 'data_validacao', 'id_pacote', 'cod_cliente', 'ilha'], 'safe'],
            [['observacao'], 'string'],
            [['ref_geog_latitude', 'ref_geog_longitude', 'status_id_status', 'user_id_user', 'projetos_id_projeto', 'clientes_id_cliente', 'zonas_id_zona'], 'integer'],
            [['cod_pedido'], 'string', 'max' => 10],
            [['acao'], 'string', 'max' => 50],
            [['morada_complementar', 'anexo'], 'string', 'max' => 255],
            [['clientes_id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['clientes_id_cliente' => 'id_cliente']],
            [['user_id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_user' => 'id']],
            [['zonas_id_zona'], 'exist', 'skipOnError' => true, 'targetClass' => Zonas::className(), 'targetAttribute' => ['zonas_id_zona' => 'id_zona']],
            [['status_id_status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPedidoProjetos::className(), 'targetAttribute' => ['status_id_status' => 'id_status']],
            [['projetos_id_projeto'], 'exist', 'skipOnError' => true, 'targetClass' => Projetos::className(), 'targetAttribute' => ['projetos_id_projeto' => 'id_projeto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_pedido' => 'Código Pedido',
            'acao' => 'Tipo Pedido',
            'morada_complementar' => 'Morada Complementar',
            'oferta_antiga' => 'Oferta Antiga',
            'oferta_nova' => 'Oferta Nova',
            'data_rececao' => 'Data Receção',
            'canal_pedido' => 'Canal Pedido',
            'observacao' => 'Observação',
            'ref_geog_latitude' => 'Ref. Geog. Latitude',
            'ref_geog_longitude' => 'Ref. Geog. Longitude',
            'anexo' => 'Anexo',
            'status_id_status' => 'Estado',
            'user_id_user' => 'Utilizador',
            'projetos_id_projeto' => 'Projeto',
            'clientes_id_cliente' => 'Nome Cliente',
            'cod_cliente' => 'Código Cliente',
            'zonas_id_zona' => 'Zona',
            'id_pacote' => 'Pacote',
            'ilha' => 'Ilha',
            'cod_cliente' => 'Código cliente'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncomendas()
    {
        return $this->hasMany(Encomendas::className(), ['pedidos_id_pedido' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoPedidos()
    {
        return $this->hasMany(HistoricoPedidos::className(), ['pedidos_id_pedido' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientesIdCliente()
    {
        return $this->hasOne(Clientes::className(), ['id_cliente' => 'clientes_id_cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonasIdZona()
    {
        return $this->hasOne(Zonas::className(), ['id_zona' => 'zonas_id_zona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusIdStatus()
    {
        return $this->hasOne(StatusPedidoProjetos::className(), ['id_status' => 'status_id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetosIdProjeto()
    {
        return $this->hasOne(Projetos::className(), ['id_projeto' => 'projetos_id_projeto']);
    }

    public function getOfertasAntiga()
    {
        return $this->hasOne(Ofertas::className(), ['id' => 'oferta_antiga']);
    }
    
    public function getOfertasNova()
    {
        return $this->hasOne(Ofertas::className(), ['id' => 'oferta_nova']);
    }
    public function getCanal()
    {
        return $this->hasOne(Parametrizacao::className(), ['id' => 'canal_pedido']);
    }

    public function changeEncomendaStatus($idPedido, $status) {
        $encomenda = Encomendas::find()->where(['pedidos_id_pedido'=>$idPedido])->all();
        $encomendas = Encomendas::find()->where(['pedidos_id_pedido'=>$idPedido])->count();
        for ($i = 0; $i < $encomendas; ++$i) {
            $encomenda[$i]->estado_encomenda = $status;
            $encomenda[$i]->save(false);
        }
    }
}
