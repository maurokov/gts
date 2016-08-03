<?php
    require("_head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("_html_head.php"); ?>
    <title>mi Flota en Línea | Gestión Usuarios</title>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("_menu.php"); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    
                        <h1 class="page-header">Hojas de ruta</h1>
                        
                        <div class="panel panel-default">
                        <div class="panel-heading">                         
                            <div class="row">
                                <div class="col-md-2">Hoja de ruta:</div>
                                <div class="col-md-2"><span class="pull-left">
                                    <input id='fecha_hoja_ruta' class='input_fecha'/></span>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-2">Intervalo:</div>
                                <div class="col-md-2">
                                    <span class="pull-left">                                        
                                        <input id='intervalo' type='number' name='quantity' value="5" min='1' max='20'>
                                    </span>
                                </div>
                                <div class="col-md-8">
                                    <span class="pull-right">
                                        <div class="btn-group">
                                            <button id="loadTable">Cargar</button>
                                            <button id="saveTable">Guardar</button>
                                            <button id="addRow">Agregar</button>
                                        </div>
                                    </span>
                                </div>
                            </div>                                                                                                                                                                                                                                                                 
                            <!-- <div class="pull-right"></div> -->
                        </div> 
                        </div>
                            
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                     
                            <!-- Aca vamos a agregar la grilla-->   
                            <table id="example" class="table" cellspacing="0" width="100%" style="margin-right:100px">
                            <div class="col-lg-12">
                                <thead>
                                    <tr>
                                        <th>Hora de salida</th>
                                        <th>Hora de llegada</th>
                                        <th>Intervalo</th>
                                        <th>Ruta</th>
                                        <th>Id Bus</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.row -->

                
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require("_html_script.php"); ?>
    
    <!-- GTS -->
    <script type="text/javascript">
        var tabla;
        var API_ENDPOINT = '<?=$API_ENDPOINT ?>';
        var ACCOUNTID = '<?=$_SESSION["accountID"] ?>';
    </script>
    
    <script src="<?=versionjs('../js/flota-utils.js');?>"></script>
    <script src="<?=versionjs('../js/usuarios.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var t = $('#example').DataTable({
                    "bLengthChange": false,
                    "bPaginate": false,
                    "bfilter": true
                    });

            var counter = 1;
            var intervalo_actual = 0;
            var lista_rutas;
            
            $('#addRow').on( 'click', function () {                                                     
                                
                if (counter==1){                    
                    intervalo_actual = $('#intervalo').val();               
                }else{

                    intervalo_actual = $('#intervalo_'+(counter-1)).val();
                }
                if(counter==1){
                    t.row.add( [
                    "<input id='hora_salida"+counter+"' class='input_hora hora_salida' type='time'/>",
                    "<input id='hora_llegada"+counter+"' class='input_hora'type='time' readonly/>",                 
                    "<input class='intervalo_tabla' id='intervalo_"+counter+"' type='number' name='quantity' value='"+intervalo_actual+"' min='1' max='15' onchange='cambiaIntervaloInferior("+counter+")'>",
                    "<select id='sel_rutas_"+counter+"' class='selector_rutas'><option value='0:"+counter+"'>Seleccione Ruta</option></select>",
                    "<select><option value=id_bus-"+counter+">id_bus-"+counter+"</option></select>",
                    ] ).draw( false );    
                }else{
                    t.row.add( [
                    "<input id='hora_salida"+counter+"' class='input_hora hora_salida' type='time' readonly/>",
                    "<input id='hora_llegada"+counter+"' class='input_hora'type='time' readonly/>",                 
                    "<input class='intervalo_tabla' id='intervalo_"+counter+"' type='number' name='quantity' value='"+intervalo_actual+"' min='1' max='15' onchange='cambiaIntervaloInferior("+counter+")'>",
                    "<select id='sel_rutas_"+counter+"' class='selector_rutas'><option value='0:"+counter+"'>Seleccione Ruta</option></select>",
                    "<select><option value=id_bus-"+counter+">id_bus-"+counter+"</option></select>",
                    ] ).draw( false );    
                }
                
                if(counter==1){                                                        
                    //$("#hora_salida1").val("07:00");
                    var d = new Date();                                        
                    $("#hora_salida1").val("7:00");
                }                               
                
                $('.selector_rutas').on('change', function() {
                    var arr = this.value.split(":");
                    var tiempoTotal = arr[0];
                    var fila = arr[1];
                    var tiempo_sal = $("#hora_salida"+fila).val();
                    var nuevoTiempo = horaStringSumarMinutos(tiempo_sal,tiempoTotal);
                    var intervalo_update_siguente = $("#intervalo_"+fila).val();
                    var salida_siguiente = horaStringSumarMinutos(nuevoTiempo,intervalo_update_siguente);                    
                    $("#hora_llegada"+fila).val(nuevoTiempo).change();
                    //$("#hora_salida"+(parseInt(fila)+1)).val(salida_siguiente).change();            

                });                                                                     
                $.each(lista_rutas, function (index, data) {
                    $("#sel_rutas_"+counter).append("<option id=ruta_"+counter+"_"+index+" value="+data["tiempoTotal"]+":"+counter+">"+data["nombre"]+"</option>");
                });                         
                $(".input_hora").datetimepicker({
                                useCurrent: false,
                                format: 'HH:mm'
                        });
                //hora de llegada es igual a hora de salida anterior + intervalo.
                
                if(counter>1 ){
                    //hora de salida actual                    
                    var hora_salida_anterior = $("#hora_salida"+(counter-1)).val();
                    var intervalo_anterior = $("#intervalo_"+(counter-1)).val();
                    if(hora_salida_anterior != ""){
                        $("#hora_salida"+counter).val(horaStringSumarMinutos(hora_salida_anterior,intervalo_anterior)).change();    
                    }                    
                }
                
                counter++;

            }); 
            
            $.ajax({
                    url: API_ENDPOINT+'/rutas/ruta/empresa_hoja_ruta/sysadmin',
                    type: 'POST',           
                    success: function(data) {
                        lista_rutas = data["data"];                 
                        // Automatically add a first row of data
                        $('#addRow').click();
                        
                    }                       
            });                                 
            
            $('#intervalo').change(function(){                
                cambiaIntervaloInferior(0);
            });

            


        } );
    </script>
    <script type="text/javascript">
        
        
        $(document).on('dp.change', '.hora_salida', function() {
                var counter = $(this).attr('id').slice(-1);
                    
                var tiempoTotal = $("#sel_rutas_"+counter).val().split(":")[0];                    
                if(tiempoTotal > 0){
                    $("#sel_rutas_"+counter).change();                        
                }
                $("#intervalo_"+counter).change();
                                        
            });
        

        function cambiaIntervaloInferior(counter) {                                             
            for(i = counter+1; i < $('#example tr').size(); i++){               
                if(counter == 0){
                    var valor = $("#intervalo").val();
                }else{
                    var valor = $("#intervalo_"+counter).val(); //valor nuevo de intervalo que cambio                    
                }
                $("#intervalo_"+i).val(valor);              //se asigna valor a intervalo siguiente                                    
                
                //modificando la hora de salida y llegada de fila que sigue                                                
                if(i > 1){
                    var hora_salida_previa = $("#hora_salida"+i).val();
                    var hora_llegada_previa = $("#hora_llegada"+i).val();                
                    var hora_salida_anterior = $("#hora_salida"+(i-1)).val(); //de fila anterior
                    
                    //cambiamos hora de salida de acuerdo al intervalo que cambio
                    if(hora_salida_anterior != ""){
                        var nueva_salida  = horaStringSumarMinutos(hora_salida_anterior,valor);    
                        $("#hora_salida"+i).val(nueva_salida).change();
                    }                
                    if(hora_llegada_previa != ""){
                        //obtener ruta seleccionada   
                        var tiempoTotal = $("#sel_rutas_"+i).val().split(":")[0];
                        var nueva_llegada  = horaStringSumarMinutos(nueva_salida,tiempoTotal);
                        $("#hora_llegada"+i).val(nueva_llegada).change();
                    }    
                }
                                
            }
        }                               
        
    </script>
    <script type="text/javascript">
                
            $(function () {                
                //$('#fecha_hoja_ruta').datetimepicker();               
                $(".input_fecha").datetimepicker({
                    useCurrent: true,                   
                    format: 'DD-MM-YYYY',       
                });
            });
            
            var today = new Date;
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            $('#fecha_hoja_ruta').val(dd+"-"+mm+"-"+yyyy);
            
            
            $(function () {                
                //$('#fecha_hoja_ruta').datetimepicker();               
                $(".input_hora").datetimepicker({
                    useCurrent: true,
                    format: 'LT'
                });
            });
            
            function horaStringSumarMinutos(hora,minutos){
                var horaSuma = "";                
                var horas = hora.split(":")[0];
                var min = hora.split(":")[1];
                var horasmas = 0;
                var minutosmas = 0;
                min = min.split(" ")[0];
                //alert(horas+" "+min);
                min = parseInt(min);
                horas = parseInt(horas);
                horas = horas + parseInt(minutos/60);
                min   = min   + parseInt(minutos%60);
                if(min >= 60){                    
                    horas = horas + parseInt(min/60);
                    min   = min - (parseInt(min/60)*60);
                }
                horaSuma = horas+":"+min;
                return horaSuma;
            }        
        
    </script>
</body>

</html>
