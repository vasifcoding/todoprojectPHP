<?php
require_once 'baglanti.php';
if(isset($_POST['todoekle'])){
$ekle= $db->prepare('INSERT INTO todo set

yapilacak=:yapilacak,
yapildi_mi=:yapildi_mi,
tarih=:tarih

');
$kaydet = $ekle->execute(array(
    'yapilacak'=>$_POST['todo'],
    'yapildi_mi'=>'H',
    'tarih'=>$_POST['tarih']
));
if($kaydet){
    Header('Location:index.php?durum=ok');
}
else{
    Header('Location:index.php?durum=no');
}
}
if(isset($_POST['sil'])){
    $sil = $db->prepare("DELETE  FROM todo where id=:id ");
    $sil->execute(array(
        "id"=> $_POST['todoid']
    ));
    if($kaydet){
        Header("Location:index.php?durum=ok");
    }else{
        Header("Location:index.php?durum=no");
    }
}
if(isset($_POST['tamamla'])){
    $tamamla = $db->prepare("UPDATE  todo SET
    yapilacak=:yapilacak,
    yapildi_mi=:yapildi_mi,
    tarih=:tarih
    WHERE id={$_POST['duzenleid']}
     ");
    $islemtamamla =  $tamamla->execute(array(
        "yapilacak"=>$_POST['duzenletodo'],
        "yapildi_mi"=>$_POST['duzenleyapildimi'],
        "tarih"=>$_POST['duzenletarih']
     ));
     if($islemtamamla){
        Header("Location:index.php?durum=ok");
     }else{
        Header("Location:index.php?durum=no");

     }
}
?>