<?php
use backend\models\User;
use backend\models\Parametrizacao;
use yii\helpers\Html;
use yii\helpers\ArrayHelper; 
use dosamigos\datepicker\DatePicker;

/* @let $this yii\web\View */

$this->title = ' Dashboard';

?>

<div class="site-index">
		
		<div class="body-content">
			<?php
				$user_id = \Yii::$app->user->identity->id;
				$user_role = \Yii::$app->user->identity->role_id;
				$currentDate = date("Y-m-d");

		        $currentMonth = date("m",strtotime($currentDate));
		        $currentYear = date("Y",strtotime($currentDate)); 

		        $pedidosDataSet = [0, 0];
		        $peidoCoordDataSet = [0, 0];

		        $pedidosCount = (new \yii\db\Query())
						->select('count(id) as val, MONTHNAME(data_rececao) as label')
						->from('pedidos')
						->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->orderby('data_rececao')
						->groupby('MONTHNAME(data_rececao)')->count();

				if ($pedidosCount > 0) {
					$pedidosDataSet = (new \yii\db\Query())
						->select('count(id) as val, MONTHNAME(data_rececao) as label')
						->from('pedidos')
						->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->orderby('data_rececao')
						->groupby('MONTHNAME(data_rececao)') 
						->all();
				} else {
					$pedidosDataSet = (new \yii\db\Query())
						->select('count(id) as val, MONTHNAME(data_rececao) as label')
						->from('pedidos')
						->where('user_id_user = ' . $user_id .' AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->orderby('data_rececao')
						->all();
				}

		        

				$peidoCoordDataSet = (new \yii\db\Query())
						->select('count(id) as val, coordenacoes.nome as label')
						->from('pedidos, zonas, regioes, coordenacoes')
						->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.coordenacao_id_coordenacao = coordenacoes.id_coordenacao AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->groupby('coordenacoes.nome') 
						->all();

				$peididoIntervaloIlhaDataSet = (new \yii\db\Query())
						->select('count(pedidos.id) as val, parametrizacao.designacao as label')
						->from('pedidos, zonas, regioes, parametrizacao')
						->where('pedidos.zonas_id_zona = zonas.id_zona AND zonas.regiao_id_regiao = regioes.id_regiao AND regioes.id_regiao AND regioes.ilha = parametrizacao.id AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->groupby('parametrizacao.designacao') 
						->all();

				$peidoStatusDataSet = (new \yii\db\Query())
						->select('COUNT(id) as val, status_pedido_projetos.designacao_estado as label ')
						->from('pedidos, status_pedido_projetos')
						->where('pedidos.status_id_status = status_pedido_projetos.id_status AND YEAR(data_rececao) = ' . $currentYear)
						->distinct()
						->groupby('status_pedido_projetos.designacao_estado') 
						->all();

				$projectStatusCount = (new \yii\db\Query())
						->select('COUNT(projetos.id_projeto) as val, status_pedido_projetos.designacao_estado as label')
						->from('projetos, status_pedido_projetos')
						->where('projetos.status_pedido_projetos_Id_status = status_pedido_projetos.id_status')
						->distinct()
						->groupby('status_pedido_projetos.designacao_estado')->count();
						if ($projectStatusCount > 0) {
							$projectStatusDataSet = (new \yii\db\Query())
								->select('COUNT(projetos.id_projeto) as val, status_pedido_projetos.designacao_estado as label')
								->from('projetos, status_pedido_projetos')
								->where('projetos.status_pedido_projetos_Id_status = status_pedido_projetos.id_status')
								->distinct()
								->groupby('status_pedido_projetos.designacao_estado') 
								->all();
						} else {
							$projectStatusDataSet = (new \yii\db\Query())
								->select('COUNT(projetos.id_projeto) as val, status_pedido_projetos.designacao_estado as label')
								->from('projetos, status_pedido_projetos')
								->where('projetos.status_pedido_projetos_Id_status = status_pedido_projetos.id_status')
								->distinct()
								->all();
						}
				

				$pedidoOutput = [["Pedido", "Total"]];
				foreach($pedidosDataSet as $row) {
					$pedidoOutput[] = [$row['label'], intval($row['val'])];
				}

				$peidoCoordOutput = [["Pedido", "Total"]];
				foreach($peidoCoordDataSet as $row) {
					$peidoCoordOutput[] = [$row['label'], intval($row['val'])];
				}

				$peidoIlhaOutput = [["Pedido", "Total"]];
				foreach($peididoIntervaloIlhaDataSet as $row) {
					$peidoIlhaOutput[] = [$row['label'], intval($row['val'])];
				}

				$peidoStatusOutput = [["Pedido", "Total"]];
				foreach($peidoStatusDataSet as $row) {
					$peidoStatusOutput[] = [$row['label'], intval($row['val'])];
				}

				$projectStatusOutput = [["Projeto", "Total"]];
				foreach($projectStatusDataSet as $row) {
					$projectStatusOutput[] = [$row['label'], intval($row['val'])];
				}

			?>

			<div class="container">
				<div class="row col-md-12">

					<div class="panel-group col-md-6">

						<div class="panel panel-primary">
			                <div class="panel-heading">
			                	<div class="row">
			                		<div class="col-md-8">
			                			<h3 class="panel-title">Performance de Pedidos</h3>
			                		</div>
		                		 	<div class="form-group col-md-4 date-selection">
		                                <?= DatePicker::widget([
											    'name' => 'generated_date',
											    'template' => '{addon}{input}',
											    'value' => date('Y'),
									        	'clientOptions' => [
									        		'defaultDate' => date('Y'),
										            'autoclose' => true,
										            'startView'=>'year',
													'minViewMode'=>'years',
													'format' => 'yyyy',
													'todayHighlight' => true
									        	], 
									        	'options' => ['onchange'=>'
									        		let year = $(this).val();

										        	$("div.doughnut-charts").show();
												    $("div.total-contato").show();

											        js:display(year); // null se user for gestor
											        
	      										'],
											]);
										?>
		                        	</div>
			                		
			                	</div>
			                </div>
				            <div class="row">
								<div >
									<div id="chart_div" style="width: auto; height: 500px; padding: 25px; display: block"></div>
													
									<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
									<script type="text/javascript">
								      google.charts.load('current', {'packages':['corechart']});
								      google.charts.setOnLoadCallback(drawVisualization);

								      function drawVisualization() {
								        // Some raw data (not necessarily accurate)
								        let data = google.visualization.arrayToDataTable(<?= json_encode($pedidoOutput)?>);


								        let options = {
								        	format: 'none',
							         	 	title : 'Número de pedidos por mês',
								          	titleTextStyle: {
													color:'#8e8e8e',
													fontSize: 18,
											},
											colors: ['#09F4F6', '#F60B09'],
											vAxis: {
												title: 'Pedidos',
												gridlines: { count: 1},
											},
											hAxis: {title: 'Mês'},
								          	visibleInLegend: false, 
								          	seriesType: 'bars',
								          	series: {12: {type: 'line'}},
									      	animation: {
					                        	"startup": true,
					                        	duration: 1500,
					                        	easing: 'out'
					                      	}
								        };

								        let chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
								        chart.draw(data, options);
								      }
								    </script>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group col-md-6">
						<div class="panel panel-danger">
			                <div class="panel-heading">
			                	<div class="row">
			                		<div class="col-md-4">
			                			<h3 class="panel-title">Performance de Pedidos</h3>
			                		</div>
		                		 	<div class="form-group col-md-4 date-selection">
		                                <?= DatePicker::widget([
											    'name' => 'generated_date',
											    'template' => '{addon}{input}',
											    'value' => date('Y-m-d'),
									        	'clientOptions' => [
									        		'defaultDate' => date('Y-m-d'),
										            'autoclose' => true,
										            'startView'=>'year',
													'minViewMode'=>'days',
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
									        	], 
									        	'options' => ['onchange'=>'
									        		let year = $(this).val();

										        	$("div.doughnut-charts").show();
												    $("div.total-contato").show();
												    let intervalStartDate = $(this).val();
											        let intervalEndDate = $(this).parent().parent().next().find("input").val();

											        js:displayInInterval(intervalStartDate, intervalEndDate);
											        
	      										'],
											]);
										?>
		                        	</div>
		                        	<div class="form-group col-md-4 date-selection">
		                                <?= DatePicker::widget([
											    'name' => 'generated_date',
											    'template' => '{addon}{input}',
											    'value' => date('Y-m-d'),
									        	'clientOptions' => [
									        		'defaultDate' => date('Y-m-d'),
										            'autoclose' => true,
										            'startView'=>'year',
													'minViewMode'=>'days',
													'format' => 'yyyy-mm-dd',
													'todayHighlight' => true
									        	], 
									        	'options' => ['onchange'=>'
									        		let year = $(this).val();

										        	$("div.doughnut-charts").show();
												    $("div.total-contato").show();

											        let intervalStartDate = $(
											        	this).parent().parent().prev().find("input").val();
											        let intervalEndDate = $(this).val();

											        js:displayInInterval(intervalStartDate, intervalEndDate);
											        
	      										'],
											]);
										?>
		                        	</div>
			                		
			                	</div>
			                </div>
				            <div class="row">
								<div >
									<div id="coordination_chart" style="padding: 25px; display: block"></div>
									<div id="island_chart" style="padding: 25px; display: block"></div>
											
									<script type="text/javascript">
								      google.charts.load("current", {packages:["corechart"]});
								      google.charts.setOnLoadCallback(drawChart);
								      function drawChart() {
								        let data = google.visualization.arrayToDataTable(<?= json_encode($peidoCoordOutput)?>);

								        let options = {
									        //legend: 'none',
									        pieSliceText: 'label',
									        title: 'Pedidos por Coordenações',
									        titleTextStyle: {
												color:'#8e8e8e',
												fontSize: 18,
											},
									        pieStartAngle: 100,
									      };

								        let chart = new google.visualization.PieChart(document.getElementById('coordination_chart'));
								        chart.draw(data, options);
								      }
								    </script>

								    <script type="text/javascript">
								      google.charts.load("current", {packages:["corechart"]});
								      google.charts.setOnLoadCallback(drawChart);
								      function drawChart() {
								        let data = google.visualization.arrayToDataTable(<?= json_encode($peidoIlhaOutput)?>);

								        let options = {
								          	title: 'Pedidos por ilhas',
								          	titleTextStyle: {
												color:'#8e8e8e',
												fontSize: 18,
											},
								          is3D: true,
								        };

								        let chart = new google.visualization.PieChart(document.getElementById('island_chart'));
								        chart.draw(data, options);
								      }
								    </script>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row col-md-12">

					<div class="panel-group col-md-6">

						<div class="panel panel-info">
			                <div class="panel-heading">
			                	<div class="row">
			                		<div class="col-md-5">
			                			<h3 class="panel-title">Performance de Pedidos</h3>
			                		</div>
			                		<div class="col-md-4 user-selection" >
		                			<?= Html::dropDownList('id', null,
		      										ArrayHelper::map(Parametrizacao::find()->where(["categoria"=>"ilha"])->all(), 'id', 'designacao'),['designacao'=>'designacao', 'prompt'=>'Selecione uma Ilha', 'style' => 'width: 100%; height: 34px;', 'onchange'=>'
														    $("div.doughnut-charts").show();
														    $("div.total-contato").show();


		      												let island = $(this).val();
		      												let date = $(this).parent().next().find("input").val();
		      												js:displayByStatus(island, date);

		      										'],['visible' => \Yii::$app->user->identity->role_id == 0] )?>
		                			</div>
		                		 	<div class="form-group col-md-3 date-selection">
		                                <?= DatePicker::widget([
											    'name' => 'generated_date',
											    'template' => '{addon}{input}',
											    'value' => date('Y'),
									        	'clientOptions' => [
									        		'defaultDate' => date('Y'),
										            'autoclose' => true,
										            'startView'=>'year',
													'minViewMode'=>'years',
													'format' => 'yyyy',
													'todayHighlight' => true
									        	], 
									        	'options' => ['onchange'=>'
									        		let year = $(this).val();

										        	$("div.doughnut-charts").show();
												    $("div.total-contato").show();

											        let island = $(this).parent().parent().prev().find(":selected").val();
									        		let date = $(this).val();

											        js:displayByStatus(island, date); 
											        
	      										'],
											]);
										?>
		                        	</div>
			                		
			                	</div>
			                </div>
				            <div class="row">
								<div >
									<div id="status_pedido_chart" style="width: auto; height: 500px; padding: 25px; display: block"></div>
											
									<script type="text/javascript">
								      google.charts.load("current", {packages:["corechart"]});
								      google.charts.setOnLoadCallback(drawChart);
								      function drawChart() {
								        let data = google.visualization.arrayToDataTable(<?= json_encode($peidoStatusOutput)?>);

								        let options = {
									        title: 'Estados dos pedidos',
									        titleTextStyle: {
												color:'#8e8e8e',
												fontSize: 18,
											},
								          is3D: true,
								        };

								        let chart = new google.visualization.PieChart(document.getElementById('status_pedido_chart'));
								        chart.draw(data, options);
								      }
								  </script>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group col-md-6">
						<div class="panel panel-warning">
			                <div class="panel-heading">
			                	<div class="row">
			                		<div class="col-md-6">
			                			<h3 class="panel-title">Performance dos Projetos</h3>
			                		</div>
		                		 	<!--div class="form-group col-md-6 date-selection">
		                                <!?= DatePicker::widget([
											    'name' => 'generated_date',
											    'template' => '{addon}{input}',
											    'value' => date('Y'),
									        	'clientOptions' => [
									        		'defaultDate' => date('Y'),
										            'autoclose' => true,
										            'startView'=>'year',
													'minViewMode'=>'years',
													'format' => 'yyyy',
													'todayHighlight' => true
									        	], 
									        	'options' => ['onchange'=>'
									        		let year = $(this).val();

										        	$("div.doughnut-charts").show();
												    $("div.total-contato").show();

											        
									        		console.log($(this).val());
											        js:display(year); // null se user for gestor
											        
	      										'],
											]);
										?>
		                        	</div-->
			                		
			                	</div>
			                </div>
				            <div class="row">
								<div >
									<div id="project_chart" style="width: auto; height: 500px; padding: 25px; display: block"></div>
										
									<script type="text/javascript">
								      google.charts.load('current', {'packages':['corechart']});
								      google.charts.setOnLoadCallback(drawVisualization);

								      function drawVisualization() {
								        // Some raw data (not necessarily accurate)
								        let data = google.visualization.arrayToDataTable(<?= json_encode($projectStatusOutput)?>);

								        let options = {
							         	 	title : 'Estados dos projetos',
								          	titleTextStyle: {
												color:'#8e8e8e',
												fontSize: 18,
											},
											colors: ['#90e0ff', '#F60B09'],
											vAxis: {title: 'Pedidos'},
												hAxis: {title: 'Mês'},
								          	visibleInLegend: false, 
								          	seriesType: 'bars',
								          	series: {12: {type: 'line'}},
									      	animation: {
					                        	"startup": true,
					                        	duration: 1500,
					                        	easing: 'out'
					                      	}
								        };

								        let chart = new google.visualization.ComboChart(document.getElementById('project_chart'));
								        chart.draw(data, options);
								      }
								    </script>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
$script = <<< JS
	$(document).ready(function() {
		let today = new Date();
		let time = today.getHours();
		if (time = 11) {
			//js:loadData();
			//console.log(time);	
		}
    });
JS;
$this->registerJs($script);

?>
