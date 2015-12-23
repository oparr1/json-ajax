<!DOCTYPE html>
<html>
<head>
  <!-- datatable css -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
</head>
<body>

<h2>Read - AJAX</h2>

<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Code</th>
            <th>Country</th>
            <th>Continent</th>
            <th>Region</th>
            <th>Surface Area</th>
            <th>Population</th>
            <th>Life Expectancy</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!-- datatable jquery -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>

<!-- Jquery Tables -->
<script>
$(document).ready( function () {
        $('#table_id').DataTable( {
    ajax: {
        url: 'app/data/jqueryTables.php',
        dataSrc: '' // object name
    },
    columns: [
        { data: 'code' },
        { data: 'name' },
        { data: 'continent' },
        { data: 'region' },
        { data: 'surfacearea' },
        { data: 'population' },
        { data: 'lifeexpectancy' }
    ]
    });

});
</script>

</body>
</html> 