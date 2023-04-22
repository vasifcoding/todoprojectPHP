<?php 
require_once 'baglanti.php';

$sec = $db->prepare('SELECT * FROM todo');
$sec->execute(array());
$duzenle = $db->prepare("SELECT * FROM todo where id=:id");
$duzenle->execute(array(
"id" => @$_GET['id']
));
$duzenlesec = $duzenle->fetch(PDO::FETCH_ASSOC);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List project</title>
 <style>
    #inputum{
        font-size:18px;
        text-align:center;
        outline:none;
        padding:10px;
        width:20rem;
        border:2px solid cyan;
    }
    #tarih{
        padding:10px;
        padding-top:10px;
        padding-bottom:10px;
    }
    a{
        color:white;
    }
    .inputlar{
        outline:none;
        padding:7px;
        border:2px cyan solid;
      
    }
    #tamamla{}
    </style>
</head>
<body class="bg-info">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
<div style="margin-top:100px;" class="col-md-6 kutucuk bg-white d-block ">
    <h1 class="text-center text-primary">TODO <span style="text-info">LIST</span> </h1>
    <div class="inputs d-flex justify-content-center p-3">
    <form action="islem.php" method="POST">
        <input style="border:2px solid cyan; outline:none;"  value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" class=" mx-3  text-info" type="date" name="tarih" id="tarih">
    <input id="inputum" type="text" name="todo" placeholder="Yapilacak Birsey Gir" class="loginput me-3">
    <button style="border:none;" class="bg-info " type="submit" name="todoekle" > <i class="fa-solid fa-plus p-3 text-white"></i> </button>
    </form> 
</div>
 <div class="tables d-block">
    <table class="table table-info">
        <thead>
     <tr>
        <th>Yapilacaklar</th>
        <th>Yapildi mi</th>
        <th></th>
        <th></th>
        <th>Son Tarih</th>
     </tr>
</thead>
<tbody>
    <?php while($calistir = $sec->fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
        <td><?php echo $calistir ['yapilacak'] ?></td>
        <td><?php if($calistir ['yapildi_mi']=="H"){
            echo 'Hayir';
        }else{echo 'Evet';} ?></td>
        <form action="islem.php" method="POST">
        <td><button class="btn btn-danger" name="sil" ><i class="fa-solid fa-trash"></i></button></td>
        <input type="hidden" name="todoid" value ="<?php echo $calistir ['id']; ?>">
        </form>
        <td><button class="btn btn-warning" > <a href="index.php?duzenle&id=<?php echo $calistir ['id'] ?>"> <i class="fa-solid fa-pencil"></i></a></button></td>
        <td><?php echo $calistir ['tarih'] ?></td>
    </tr>
        <?php }?>
</tbody>
</table>
 </div>
</div>
<div class="col-md-3"></div>

</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mt-5">
        <div class=" p-3 kutucuk bg-white <?php if(isset($_GET['duzenle'])){echo 'd-block';}else{echo 'd-none';} ?>">

        <h3 class="text-center text-primary">Duzenle Menüsü</h3>
        <form action="islem.php" method="POST">
          <input value="<?php echo $duzenlesec['yapilacak'] ?>"  type="text" class="inputlar"  name="duzenletodo">
          <input value="<?php echo $duzenlesec['yapildi_mi'] ?>" maxlength="1" type="text" class="inputlar"  name="duzenleyapildimi">
          <input value="<?php echo $duzenlesec['tarih'] ?>" type="date" class="inputlar"  name="duzenletarih">
          <button style="border:none;" name="tamamla" class="bg-success text-white m-3 px-4 py-3 fs-6">Tamamla</button>
          <input type="hidden" name="duzenleid" value="<?php echo $duzenlesec ['id']; ?>" >
    </form>
          </div>
    </div>
    <div class="col-md-3"></div>
</div>
</div>
  </div>
</div>














<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>