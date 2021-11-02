<!DOCTYPE html>
<html>
<head>
<!-- Laravel 8 Datatables Tutorial - ItSolutionStuff.com EXEMPLO -->
    <title>Datatable Jquery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container">
    <h1>List</h1>
    <table class="table table-bordered" id="tableList">
        <thead>
            <tr>
                <th>PLATAFORMA</th>
                <th>CLIENTE</th>
                <th>ARTICULO</th>
                <th>TOT_STOCK</th>
                <th>TOTAL_LINEAS</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="container" id="specific">
    <h1>Specific List</h1>
    <table class="table table-bordered" id="specificTable">
        <thead>
            <tr>
                <th>PLATAFORMA</th>
                <th>CLIENTE</th>
                <th>ARTICULO</th>
                <th>ALMACEN</th>
                <th>UBICACOIN</th>
                <th>ID</th>
                <th>LOTE</th>
                <th>UNIDADES</th>
                <th>SSCC</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

<script type="text/javascript">
$('#specific').hide();

 function specific(idArticulo){
    var table = $('#specificTable').DataTable();
    table.clear().draw();
    $.ajax({
        type: 'GET',
        url: `http://localhost:8080/api/list/${idArticulo}`,

        success: function(data) {
            $('#specific').show();
            for (var i = 0; i < data.length; i++) {
            table.row.add([
                    data[i].plataforma,
                    data[i].cliente,
                    data[i].articulo,
                    data[i].almacem,
                    data[i].ubicacion,
                    data[i].id,
                    data[i].lote,
                    data[i].unidades,
                    data[i].sscc
            ]).draw();
            }
        }
    });
 }

$(document ).ready(function() {
    var table = $('#tableList').DataTable();
    $.ajax({
        type: 'GET',
        url: 'http://localhost:8080/api/list',

        success: function(data) {
            for (var i = 0; i < data.length; i++) {
                var idArticulo = data[i].articulo;
                var articulo = `<a style="color:red;cursor:pointer;" onclick="specific(${idArticulo});">${idArticulo}</a>`;
            table.row.add([
                    data[i].plataforma,
                    data[i].cliente,
                    articulo,
                    data[i].tot_stock,
                    data[i].total_lineas,
            ]).draw();
            }
        }
    });

  });
</script>
</html>
