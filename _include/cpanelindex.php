
               
                <!--  ################################################################################################################-->
    <!--  Inicio Informacion general del Cpanel-->
    <!--  ################################################################################################################-->
  
  <?php
  
  $inform = consulta($conexion,"SELECT COUNT(*) as 'Número de usuarios'
                                FROM usuarios
                                GROUP BY sexo
                                having sexo=0"); 
  $soluc=mysqli_fetch_array($inform);
  
 $inform2 = consulta($conexion,"SELECT COUNT(*) as 'Número de usuarios'
                                FROM usuarios
                                WHERE baja like 0
                                GROUP BY sexo
                                having sexo=1"); 
  $soluc2=mysqli_fetch_array($inform2);
                    
 $inform3 = consulta($conexion,"SELECT COUNT(*) as 'Número de usuarios'
                                FROM usuarios
                                WHERE baja = 0
                                GROUP BY tipo
                                having tipo=1"); 
  $soluc3=mysqli_fetch_array($inform3);
     
  $inform4 = consulta($conexion,"SELECT COUNT(*) as 'Número de usuarios'
                                FROM usuarios
                                WHERE baja = 0
                                GROUP BY tipo
                                having tipo=2"); 
  $soluc4=mysqli_fetch_array($inform4);
                  
  ?>
      <!--Inicio Contenido CPanel Administrador-->

  <!--   Inicio Barra progresiva conteo de proyectos-->
   <div id="titbar"><span><?=PROBAR?></span></div>
    <div id="myProgress">
      <div id="myBar">0%</div>
    </div>
   
    <div id="textbar" class="ocul"><span><?=GENINFO?></span></div>


<!--   Fin Barra progresiva conteo de proyectos-->
  
  <!--   Inicio Grafico usuarios hombres/mujeres cpanel-->
<section id="grafics" class="ocul">
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Genero', 'Numero de usuarios'],
          ['<?= $soluc['Número de usuarios'] ?> <?=HOMS?>',     <?= $soluc['Número de usuarios'] ?>],
          ['<?= $soluc2['Número de usuarios'] ?> <?=MUJS?>',     <?= $soluc2['Número de usuarios'] ?>]
        ]);
        var options = {
          title: '<?=USUGEN?>',
          backgroundColor: 'transparent',
          fontSize: 12,
            'width':350,
          chartArea: {left:40,top:40,bottom:10,width:'80%',height:'80%'},
          //colors:['#363d91','#be2d2d'],
          pieSliceTextStyle: {color: 'black'},
          pieSliceText: 'percentage',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
 
  <div id="piechart_3d"></div>
  
  <!--Fin Graficos usuarios hombres/mujeres Cpanel -->
  
  <!--   Inicio Grafico usuarios profesores/alumnos cpanel-->
  
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Rol', 'Numero de usuarios'],
          ['<?= $soluc3['Número de usuarios'] ?> <?=PROFES?>',     <?= $soluc3['Número de usuarios'] ?>],
          ['<?= $soluc4['Número de usuarios'] ?> <?=ALUMS?>',     <?= $soluc4['Número de usuarios'] ?>]
        ]);
        var options = {
          title: '<?=USUTIP?>',
          backgroundColor: 'transparent',
          fontSize: 12,
          'width':350,
          chartArea: {left:40,top:40,bottom:10,width:'80%',height:'80%'},
          pieSliceTextStyle: {color: 'black'},
          pieSliceText: 'percentage',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        chart.draw(data, options);
      }
    </script>
  
  <div id="piechart_3d2"></div>
  <!--   Fin Grafico usuarios profesores/alumnos cpanel-->
  <!--  Inicio tabla info proyectos-->
  
  <?php
    $consul = consulta($conexion,"select p.id_proyecto, p.nombre_pro, p.name_pro, p.fecha_pub, u.id_user, concat(u.nombre,' ',u.apellidos) as coordinador
                                    from proyectos p, usuarios u, usuproy up
                                    WHERE  p.mostrar like 1 and u.id_user=up.id_user
                                    AND up.id_proyecto=p.id_proyecto
                                    AND u.tipo=1
                                    order by fecha_pub desc"); 
  
    $consul2 = consulta($conexion,"select COUNT(up.id_user) as 'Numero de participantes'
                                    FROM usuproy up, usuarios u, proyectos p
                                    WHERE up.id_user=u.id_user
                                    AND up.id_proyecto=p.id_proyecto
                                    AND u.tipo=2
                                    GROUP BY up.id_proyecto
                                    ORDER BY p.fecha_pub desc"); 
                         
        ?><div id="tabladatos">
            <table class="tabla">
            <th><?=POY?></th><th><?=PUBL?></th><th><?=COOR?></th>
               <?php
                while ($sol=mysqli_fetch_array($consul)){?>
                        <tr>
                            <td><a href="proyecto.php?idp=<?=$sol['id_proyecto']?>"><?php
                                    if(isset($_SESSION['lang'])){
                                        if($_SESSION['lang']==1){
                                            echo $sol['name_pro'];
                                        }else{
                                            echo $sol['nombre_pro'];
                                            }
                                        }else{
                                        echo $sol['nombre_pro'];
                                    }
                                ?></a>            
                                    </td>
                                    <td><?=$sol['fecha_pub']?></td>
                                    <td><a href="profilever.php?idu=<?=$sol['id_user']?>&a=2"><?=$sol['coordinador']?></a></td>
                        </tr>
                        <?php } ?>
            </table>
    </div>
  
  <!--  Fin tabla info proyectos-->

  </section>