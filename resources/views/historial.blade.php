<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<h2 style="text-align: center">Historial del Clima</h2><hr>
<div class="container-fluid">
    <table class="table" id="table" style="overflow-x:auto;">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th class="text-center">City</th>
                <th class="text-center">Lon</th>
                <th class="text-center">Lat</th>
                <th class="text-center">Temp</th>
                <th class="text-center">Temp_Min</th>
                <th class="text-center">Temp_Max</th>
                <th class="text-center">Feels_Like</th>
                <th class="text-center">Pressure</th>
                <th class="text-center">Humidity</th>
                <th class="text-center">Speed</th>
                <th class="text-center">Deg</th>
                <th class="text-center">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td></td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->user->city}}</td>
                <td>{{$item->lon}}</td>
                <td>{{$item->lat}}</td>
                <td>{{$item->temp}}</td>
                <td>{{$item->temp_min}}</td>
                <td>{{$item->temp_max}}</td>
                <td>{{$item->feels_like}}</td>
                <td>{{$item->pressure}}</td>
                <td>{{$item->humidity}}</td>
                <td>{{$item->speed}}</td>
                <td>{{$item->deg}}</td>
                <td>{{$item->date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table><hr>
        <button  class="delete-modal btn btn-success" type="button" onclick="window.location='{{ url("/") }}'"><span class="glyphicon glyphicon-cool"></span> Regresar</button><br><br>
</div>
<script>
    $(document).ready(function() {
      $('#table').DataTable();
  } );
   </script>
