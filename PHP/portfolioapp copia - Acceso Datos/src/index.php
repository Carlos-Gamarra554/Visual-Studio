<?php include("templates/header.php"); ?>
<?php include("mysql/db_credenciales.php"); ?>

<?php
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
  } catch(PDOException $e) {
    echo "La conexión ha fallado: " . $e->getMessage();
  }
?>

<div class="container mb-5">
    <div class="row">

    </div>
</div>

<?php include("templates/footer.php"); ?>