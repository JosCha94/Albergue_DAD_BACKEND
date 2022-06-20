<?php
require_once('BL/consultas_perritos.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_perrito();
$perro = $consulta->listarPerritos($conexion);

?>



<h2 class="text-center mt-3 h1">Perritos</h2>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-5">
            <table class="table table-sm table-hover" id="tablaPerritos">
                <thead class="bg-danger text-white text-center table-heading">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del perro</th>
                        <th scope="col">Peso (en Kg.)</th>
                        <th scope="col">Tamaño</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Nivel de actividad</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fotos</th> 
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Fecha de modificación</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deshabilitar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($perro as $key => $value) : ?>

                    <tr>
                        <td><?= $value['perro_id'] ;?></td>
                        <td><?= $value['perro_nombre'] ;?></td>
                        <td><?= $value['perro_peso'] ;?></td>
                        <td><?= $value['perro_tamano'] ;?></td>
                        <td><?= $value['perro_nacimiento'] ;?></td>
                        <td><?= $value['perro_sexo'] ;?></td>
                        <td><?= $value['perro_actividad'] ;?></td>
                        <td><?= $value['perro_descripcion'] ;?></td>
                        <td><?= $value['perro_estado'] ;?></td>
                        <td><a class="btn btn-primary btn-sm" type="button" onclick="showDetails(this)" data-bs-toggle="modal" data-bs-target="#imgModal" data-id="<?= $value['perro_id'] ;?>">Ver</a></td>
                        <td><?= $value['perro_fecha_creacion'] ;?></td>
                        <td><?= $value['perro_fecha_modificacion'] ;?></td>
                        <td>
                            <span class="btn btn-warning btn-xs" title="Editar"><i class="fa-solid fa-pen-to-square"></i></span>
                        </td>
                        <td>
                            <span class="btn btn-danger btn-xs" title="Desabilitar perrito"><i class="fa-solid fa-power-off"></i></span>
                        </td>
                <?php endforeach; ?>
                            
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Nombre del perrito</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        <div class="modal-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
