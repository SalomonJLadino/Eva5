<?php include("db.php") ?> 
<?php include("includes/header.php") ?>


    <a href="start.html" class="logo">
        <img src="Imagenes/Logo.png" alt="logo Ciberseguridad" width="80" height="80">
    </a>

    <div class="container p-4">

    <?php if(isset($_SESSION['message'])) {?>
        <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php session_unset(); } ?>    

        <div class="row">
            <div class="col-md-4">
                <div class="card card-body">
                    <form action="save_note.php" method="POST">
                       <div class="form-group">
                            <input type="text" name="titulo" class="form-control" placeholder="Nombre" autofocus>
                       </div>
                       <div class="form-group">
                           <textarea name="descripcion" class="form-control" placeholder="Usuario"></textarea>
                       </div>
                       <input type="submit" class="btn btn-success btn-block" name="save_note" value="Guardar">
                    </form>
                </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <body>
                    <?php
                       $query =  "SELECT * FROM notas";
                       $result_notas = mysqli_query($conn, $query);
                       while($row = mysqli_fetch_array($result_notas)){ ?>
                        <tr>
                          <td><?php echo $row['titulo']?></td>
                          <td><?php echo $row['descripcion']?></td> 
                          <td><?php echo $row['creacion']?></td> 
                          <td>
                            <a href="edit_note.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                <i class="fas fa-marker"></i>
                            </a>
                            <a href="delete_note.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                          </td>    
                        </tr>
                    <?php }?>
                </body>
            </table>
        </div>
        </div>
    </div>
    <div class="imprimir">
    <a href="pdf.php" class="btn btn">Imprimir Reporte</a>
    </div>

<?php include("includes/footer.php") ?>