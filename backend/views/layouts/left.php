
<?php
 $admin = \Yii::$app->user->identity->role_id == 1;
 $userRole = \Yii::$app->user->identity->role_id;
 $identy = \Yii::$app->user->identity;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image"> 
                <?php 
                    $img = '<img src="'. \Yii::$app->user->identity->photo .'" class="img-circle"
                                 alt="User Image"/>';  
                    echo $img;

                ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $identy->name; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Dashboard', 'icon' => 'fas fa-dashboard','url' => ['site/index']],   

                    [
                        'label' => 'Cadastro',
                        'icon' => 'fas fa-sign-in',
                        'url' => '?r=cadastro/index',
                        'active' => $this->context->route == 'cadastro/index',
                        'visible' => $userRole == 3 || $userRole == 1,
                    ],
                    [
                        'label' => 'Cliente',
                        'icon' => 'fas fa-user',
                        'url' => '?r=clientes',
                        'active' => $this->context->route == 'clientes/index',
                    ],
                    [
                        'label' => 'Encomenda',
                        'icon' => 'fas fa-gift',
                        'url' => '?r=encomendas',
                        'active' => $this->context->route == 'encomendas/index',
                    ],
                    [
                        'label' => 'Pedido',
                        'icon' => 'fas fa-paper-plane',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Ver pedido',
                                'icon' => 'fas fa-eye',
                                'url' => '?r=pedidos',
                                'active' => $this->context->route == 'pedidos/index',
                                'visible' => $userRole != 3,
                            ],
                            [
                                'label' => 'Validação',
                                'icon' => 'fas fa-check',
                                'url' => '?r=pedidos/validacao',
                                'active' => $this->context->route == 'pedidos/validacao',
                                'visible' => $userRole == 1 || $userRole == 3 || $userRole == 4 || $userRole == 5,
                            ],
                            [
                                'label' => 'Sem disponibilidade',
                                'icon' => 'fas fa-stop-circle',
                                'url' => '?r=pedidos/semdisponibilidade',
                                'active' => $this->context->route == 'pedidos/semdisponibilidade',
                                'visible' => $userRole == 1 || $userRole == 5,
                            ],
                            [
                                'label' => 'Fechado sem aprovação',
                                'icon' => 'fas fa-times',
                                'url' => '?r=pedidos/semaprovacao',
                                'active' => $this->context->route == 'pedidos/semaprovacao',
                                'visible' => $userRole == 1 || $userRole == 5,
                            ],
                        ]
                    ],
                    [
                        'label' => 'Parametrização',
                        'icon' => 'fas fa-cogs',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Coordenação',
                                'icon' => 'fas fa-location-arrow',
                                'url' => '?r=coordenacoes',
                                'active' => $this->context->route == 'coordenacoes/index',
                            ],
                            [
                                'label' => 'Região',
                                'icon' => 'fas fa-globe',
                                'url' => '?r=regioes',
                                'active' => $this->context->route == 'regioes/index',
                            ],
                            [
                                'label' => 'Zona',
                                'icon' => 'fas fa-map',
                                'url' => '?r=zonas',
                                'active' => $this->context->route == 'zonas/index',
                            ],
                        ],
                        'visible' => $userRole == 1, 
                    ],
                    [
                        'label' => 'Projeto',
                        'icon' => 'fas fa-tasks',
                        'url' => '?r=projetos',
                        'active' => $this->context->route == 'projetos/index',
                        'visible' => $userRole == 1 || $userRole == 5 || $userRole == 4 || $userRole == 2,
                    ],
                    [
                        'label' => 'Utilizador',
                        'icon' => 'fas fa-users',
                        'url' => '?r=user',
                        'active' => $this->context->route == 'user/index',
                        'visible' => $userRole == 1,
                    ],

                ]
            ]
        ) ?>

    </section>

</aside>
