$(function(){
  $('#contatoButton').click(function(){
    $('#modal-Cliente').modal('show')
    .find('#modalContentCliente')
    .load($(this).attr('value'));
    alert("tssa");
  });
});

$(function(){
  $('#projetoButton').click(function(){
    $('#modal-projeto').modal('show')
    .find('#modalContentProjeto')
    .load($(this).attr('value'));
  });
});

$(function(){
  $('#RefButton').click(function(){    
    $('#modal-map').modal('show')
    .find('#modalMap')
    .load($(this).attr('value'));
    alert("tssa");
  });
});

$(function(){
	$('#AddButton').click(function(){
		$('#modal-add').modal('show')
		.find('#modalContentAdd')
		.load($(this).attr('value'));
	});
});

function openPopUpVer(obj){
         $('#modal-id-ver').modal('show')
            .find('#modalContentVer')
            .load($(obj).attr('value'));
}

function openPopUpEditar(obj){
         $('#modal-id-editar').modal('show')
            .find('#modalContentEditar')
            .load($(obj).attr('value'));
}

function openCreatePddPopUp(obj){
         $('#modal-id-createPdd').modal('show')
            .find('#modalContentCreatePdd')
            .load($(obj).attr('value'));
            console.log($(obj))
}

function openPopUp(obj){
         $('#modal-id-indicador').modal('show')
            .find('#modalContentInd')
            .load($(obj).attr('value'));}

function openPopUpVerPdd(obj){
         $('#modal-id-verPdd').modal('show')
            .find('#modalContentVer')
            .load($(obj).attr('value'))
}

function openPopProjectUp(obj){
         $('#modal-id-projeto').modal('show')
            .find('#modalContentProjeto')
            .load($(obj).attr('value'));
}

function openPopUpEncomenda(obj){
         $('#modal-id-encomenda').modal('show')
            .find('#modalContentEncomenda')
            .load($(obj).attr('value'));
}
function openMap(obj) {
            console.log($(obj).attr('value'))

    $('#modal-map').modal('show')
            .find('#modalMap')
            .load($(obj).attr('value'));

            console.log($(obj))
}

function saveIt(lat, lng) {
    console.log('Latitude: ' + lat + ', Longitude: ' + lng)
}

function display(date) {
  getPedidos(date);
}

function displayByStatus(island, date) {
  getStatusPedidos(island, date);
}
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}
function loadData() {
  console.log("Loading...");
  sleep(4000).then(() => {
    console.log('4 seconds later, showing sleep in a loop...');
  });
  
  $.ajax({
        method: "POST",
        //url: "index.php?r=pedidos/listpedidos&date=",
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawPedidosChart(data);
  });
}

function displayInInterval(startDate, endDate) {
  getPedidosCoodInInterval(startDate, endDate);
  getPedidosIlhaInInterval(startDate, endDate);
}

// The data fetch happens here

function getPedidos(date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=pedidos/listpedidos&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawPedidosChart(data);
  });

}

function getStatusPedidos(island, date) {

  $.ajax({
        method: "POST",
        url: "index.php?r=pedidos/listpedidosstatus&island="+island+"&date="+date,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawStatusPedidosChart(data);
  });

}

function getPedidosCoodInInterval(startDate, endDate) {
   $.ajax({
        method: "POST",
        url: "index.php?r=pedidos/listpedidoscoordininterval&startDate="+startDate+"&endDate="+endDate,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawPedidosCoordChart(data);
  });
}

function getPedidosIlhaInInterval(startDate, endDate) {
   $.ajax({
        method: "POST",
        url: "index.php?r=pedidos/listpedidosilhaininterval&startDate="+startDate+"&endDate="+endDate,
        dataType: "JSON",
        invokedata: {
            callingSelect: $(this)
        }
  }).done(function( data ) {
      drawPedidosIslandChart(data);
  });
}

// The charts drawing happens here

google.charts.load('current', {'packages':['corechart', 'controls']});
google.charts.setOnLoadCallback();
function drawPedidosChart(dat) {
  const data = new google.visualization.arrayToDataTable(dat);

  let options = {
      title : 'Número de pedidos por mês',
      titleTextStyle: {
      color:'#8e8e8e',
      fontSize: 18,
      },
      colors: ['#09F4F6', '#F60B09'],
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

    let chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

function drawPedidosCoordChart(dat) {
  const data = new google.visualization.arrayToDataTable(dat);
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

function drawPedidosIslandChart(dat) {
  const data = new google.visualization.arrayToDataTable(dat);
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

  let chart = new google.visualization.PieChart(document.getElementById('island_chart'));
  chart.draw(data, options);
}

function drawStatusPedidosChart(dat) {
  const data = new google.visualization.arrayToDataTable(dat);

  let options = {
    title: 'Pedidos por estado',
    titleTextStyle: {
      color:'#8e8e8e',
      fontSize: 18,
    },
    is3D: true,
  };

  let chart = new google.visualization.PieChart(document.getElementById('status_pedido_chart'));
  chart.draw(data, options);
}
