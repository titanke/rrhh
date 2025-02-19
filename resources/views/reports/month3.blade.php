@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resumen Asistencia 02</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <select class="form-control form-control-solid" id="yearSelector">
                                <option value='2024'>2024</option>
                                <option value='2023'>2023</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control form-control-solid" id="monthSelector">
                                <option value='1'>Enero</option>
                                <option value='2'>Febrero</option>
                                <option value='3'>Marzo</option>
                                <option value='4'>Abril</option>
                                <option value='5'>Mayo</option>
                                <option value='6'>Junio</option>
                                <option value='7'>Julio</option>
                                <option value='8'>Agosto</option>
                                <option value='9'>Setiembre</option>
                                <option value='10'>Octubre</option>
                                <option value='11'>Noviembre</option>
                                <option value='12'>Diciembre</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" type="button" onclick="recargarReporte();"><i class="fas fa-fw fa-search"></i> Buscar</button>

                        </div>
                    </div>
                    
                    <hr/>
                    
                    <table class="table table-bordered table-striped" id="summary-table" style="font-size: 0.5em;">
                        <thead>                        
                            <tr>  
                                <th>Reg.</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>01</th>
                                <th>02</th>
                                <th>03</th>
                                <th>04</th>
                                <th>05</th>
                                <th>06</th>
                                <th>07</th>
                                <th>08</th>
                                <th>09</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th>
                                <th>Min</th>
                                <th>Obs</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')

<script>

    var tablaReporte = $('#summary-table').DataTable({
        processing: true,
        scrollX: true, 
        language: { "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>' },
        serverSide: true,
        ajax: 'getMonth2/'+$('#monthSelector').val()+'/'+$('#yearSelector').val(),
        columns: [
        { data: 'regimen', name: 'regimen', orderable: false },
        { data: 'dni', name: 'dni', orderable: false },
        { data: 'name', name: 'name' },
        ...Array.from({length: 33}, (_, i) => i + 1).map(index => ({
            data: 'marcas',
            name: 'marcas',
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
                return evaluador(data, row.anio, row.mes, index);
            }
        })),
  

    ],
        order: [[2, 'asc']],
        columnDefs: [{
            targets: 1,
            className: 'dt-right'
        }],
        layout: {
            top2Start: {
                buttons: ['excel', {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A3',
                    title: function() {
                    var year = $('#yearSelector').val();
                    var month = $('#monthSelector').val();
                    var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                return 'Reporte: ' + monthNames[month - 1] + ' ' + year;
            },
                        customize: function (doc) {
                            var year = $('#yearSelector').val();
                            var month = $('#monthSelector').val();
                            var monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                            doc.content[0] = {
                                columns: [
                    
                            {
                                text: monthNames[month - 1] + ' ' + year,
                                width: 50, 
                            alignment: 'center'
                            }
                        ] 
                        };
                        doc.content[1].table.widths = [36, 38, 43, ...Array(33).fill(23)]; 
                        doc.pageMargins = [5, 5, 5, 5];
                        doc.styles.tableHeader.fontSize = 8; 
                        doc.defaultStyle.fontSize = 8; 
                
                    }
                }
            ]
            }
}
        
    });

function recargarReporte(){
    tablaReporte.ajax.url('getMonth2/'+$('#monthSelector').val()+'/'+$('#yearSelector').val()).load();
}




function evaluador(attendancesList, year, month, day) {
  const attendances = attendancesList.split(",");
  const attendancesDay = [];
  const attendancesDayObs = [];

  var dayEvaluation = new Date(year, month - 1, day);

  if (dayEvaluation > Date.now()) {
    return "";
  }
  let totalMinutes = 0;
    const diasConMasAsistencias = new Array(31).fill(0);

    attendances.forEach(attendance => {
      
        const timestamp = new Date(attendance);
        const hours = timestamp.getHours();
        const minutes = timestamp.getMinutes();
        const dayOfMonth = timestamp.getDate();
        const rango1Limite = 10;
        const rango2Limite = 5;

    
        if (day === 32) {
            if (hours === 8 && minutes > 0) {
                totalMinutes += Math.min(minutes, rango1Limite);
            }
            if (hours === 14 && minutes > 30) {
                totalMinutes += Math.min(minutes - 30, rango2Limite);
            }
        }
        if (day === 33) {
            diasConMasAsistencias[dayOfMonth - 1]++;
        }

    });

    if (day === 32) {
        return `<b>${totalMinutes}</b>`;
    }

    if (day === 33) {
        const diasConMasAsistenciasFiltrados = diasConMasAsistencias.filter(count => count > 4 || count === 2);
        if (diasConMasAsistenciasFiltrados.length >= 1) {
            return "<span class='text-danger'>*</span>";
        }
    }



  attendances.forEach(function (fecha) {
    const fechaid = fecha.replace(/[A-Z]$/, '');
    const date = new Date(fechaid);    
    if (date.getDate() == day) {
      if (/[A-Z]$/.test(fecha)) {
        attendancesDay.push(fecha.slice(-1));
    } else {
        const hora = fecha.substring(11, 16);
        attendancesDay.push(hora);
    }  
    }
  });

  if (dayEvaluation.getMonth() != month - 1) {
    return "";
  }

  if (dayEvaluation.getDay() == 0 || dayEvaluation.getDay() == 6) {
    if (attendancesDay.length >= 4) {
    var str = "<center>";
    var uniqueValueCount = {}; 
    attendancesDay.forEach(function(hora) {
      uniqueValueCount[hora] = (uniqueValueCount[hora] || 0) + 1;
    });
    var repeatedValue = Object.keys(uniqueValueCount).find(key => uniqueValueCount[key] === 4);

    if (repeatedValue) {
      str += "<span class='text-info'>" + "X" + "</span>";
    } else {
      attendancesDay.forEach(function(hora) {
        str += hora + "<br/>";
      });
    }
  return str + "</center>";
}else {
      if (attendancesDay.length > 0) {
        var str = "";        
        attendancesDay.forEach(function (hora) {
          str += hora + "<br>";
        });
        return "<span class='text-danger'>" + str + "</span>";
      } else {
        if (dayEvaluation.getDay() == 0) {
          return "<span class='text-info font-weight-bold'>D</span>";
        } else {
          return "<span class='text-info font-weight-bold'>S</span>";
        }
      }
    }
  }

  if (attendancesDay.length >= 4) {
      var str = "<center>";
      var uniqueValueCount = {}; 
      attendancesDay.forEach(function(hora) {
        uniqueValueCount[hora] = (uniqueValueCount[hora] || 0) + 1;
      });
      var repeatedValue = Object.keys(uniqueValueCount).find(key => uniqueValueCount[key] === 4);

      if (repeatedValue) {
        str += "<span class='text-secondary'>" + repeatedValue + "</span>";
      } else {
      attendancesDay.forEach(function (hora) {
        str += hora + "<br/>";
      });
    }
    return str;
  } else {
    if (attendancesDay.length > 0) {
      var str = "";
      attendancesDay.forEach(function (hora) {
        str += hora + "<br>";
      });
      return "<span class='text-danger'>" + str + "</span>";
    } else {
      return "";
    }
  }

}


</script>


@endpush

