<!--
<select class="teq">
    <option value="0">airchiet teqnika</option>
    <option value="1">pc</option>
    <option value="2">leptop</option>
</select>
-->    <?php

echo "<div><a href='" . $viu->urlbase . "/home/sheuft/'><button class='autcss'>უკან დაბრუნება</button></a></div><div class='shesgrnt'>";
$invrao = count($viu->data[0]['inv']);
$prodrao = count($viu->data[0]['prod']);
$pr = count($viu->data[0]['pr']);
$inp = count($viu->data[0]['inp']);
foreach ($viu->data[0]['grvtitle'] as $item) {
    echo "<b>რედაქტირება: </b><a href='?red=".$item['kontaqt']."&incode=".$item['invCode']."'>".$item['title']."</a> | <a href='?dell=".$item['kontaqt']."&incode=".$item['invCode']."'>წაშლა</a> <br> ";
}
echo "</div><Br>";
?>
<select id="dynamic_select">
    <option value="?code=0">ახლის დამატება</option>
    <?php
    for ($i = 0; $i < $invrao; $i++) {
        if(isset($_GET['code'])){if($_GET['code'] == $viu->data[0]['inv'][$i]['invCode']){$sle = "selected=\"selected\"";} else{$sle=" ";}}else{$sle=" ";}
        echo " <option ".$sle." value=\"?code=" . $viu->data[0]['inv'][$i]['invCode'] . "\">" . $viu->data[0]['inv'][$i]['proName'] . "</option>";
    }

    ?>
</select>
<?php if(isset($_GET['code']) && $_GET['code'] > 0){ ?>
<form action="" method="post" enctype="multipart/form-data">
    <label>სათაური: </label><br>
    <input type="text" name="fname"><br>
        <?php
        if (isset($_GET['code'])) {
            for ($i = 0; $i < $invrao; $i++) {
                if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['code']) {
                    echo "<h2>" . $viu->data[0]['inv'][$i]['proName'] . "</h2>";
                    echo "<input type='hidden' value='".$viu->data[0]['inv'][$i]['invCode']."' name='inv'>";
                    for ($k = 0; $k < $prodrao; $k++) {
                        if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv'][$i]['invCode']){
                            echo "<div class=\"cpu\">";
                            echo "<div class='nawtitle'><h4>" . $viu->data[0]['prod'][$k]['proName'] . "</h4></div><hr>";
                            echo "<input type='hidden' value='".$viu->data[0]['prod'][$k]['proCode']."' name='prod[]'>";
                            for ($j=0;$j<$pr;$j++){
                                if($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']){
                                    echo "<span>".$viu->data[0]['pr'][$j]['proSetName']."</span><br>";
                                    echo "<input type='hidden' value='".$viu->data[0]['pr'][$j]['proSetCode'] ."/".$viu->data[0]['prod'][$k]['proCode']."' name='pr[]'>";
                                    for ($l=0;$l<$inp;$l++){
                                        if($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']){

                                            echo "<input type=\"".$viu->data[0]['inp'][$l]['intType']."\" name='".$viu->data[0]['pr'][$j]['inName']."'><br>";
                                        }
                                    }
                                }
                            }
                            echo "</div>";
                        }
                    }
                }
            }
        }
        ?>
    <div class="cpu">
        <h4>დამატებითი ინფორმაცია</h4><hr>
        <br>
        <span>ნვოისი: </span>
        <input type="file" name="invois"><br>
        <span>კომენტარი: </span>
        <textarea name="kom"></textarea><br>
        <input type="submit" value="ატვირთვა">
        <input type="submit" value="აქტივაცია" name="active">
    </div>
</form>
<?php } ?>

<?php if(isset($_GET['red'])){ ?>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET['incode'])) {
            for ($i = 0; $i < $invrao; $i++) {
                if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['incode']) {
                    echo "<h2>" . $viu->data[0]['inv'][$i]['proName'] . "</h2>";
                    echo "<input type='hidden' value='".$viu->data[0]['inv'][$i]['invCode']."' name='inved'>";
                    for ($k = 0; $k < $prodrao; $k++) {
                        if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv'][$i]['invCode']){
                            echo "<div class=\"cpu\">";
                            echo "<div class='nawtitle'><h4>" . $viu->data[0]['prod'][$k]['proName'] . "</h4></div><hr>";
                            echo "<input type='hidden' value='".$viu->data[0]['prod'][$k]['proCode']."' name='prod[]'>";
                            for ($j=0;$j<$pr;$j++){
                                if($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']){
                                    echo "<span>".$viu->data[0]['pr'][$j]['proSetName']."</span><br>";
                                    echo "<input type='hidden' value='".$viu->data[0]['pr'][$j]['proSetCode'] ."/".$viu->data[0]['prod'][$k]['proCode']."' name='pr[]'>";
                                    for ($l=0;$l<$inp;$l++){
                                        if($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']){
                                            //
                                            foreach ($viu->data[0]['grformedit'] as $item) {
                                                if($item['invCode'] == $viu->data[0]['inv'][$i]['invCode'] && $item['proCode'] == $viu->data[0]['pr'][$j]['proCode'] && $item['prSetCode'] == $viu->data[0]['pr'][$j]['proSetCode']){
                                                    foreach ($viu->data[0]["chekb"] as $chekitem) {
                                                        if($chekitem['typID'] == 2 && $chekitem['prSetCode'] == $viu->data[0]['pr'][$j]['proSetCode'] && $chekitem['kontaqt'] == $_GET['red'] && $chekitem['teqValue'] == "on"){
                                                           $chek = "checked=\"checked\"";
                                                        }
                                                }
                                                if($item['editinp'] == 1 && $item['active'] == 0){
                                                        $aucil = "<b style='color: #F00000'>&#42; </b>";
                                                }else{$aucil = "";}
                                                if(!isset($chek) || empty($chek)){$chek="";}
                                                    echo "<input type='hidden' value='".$item['id']."' name='".$viu->data[0]['pr'][$j]['inName']."1'>";
                                                    echo $aucil. " <input ".$chek." type=\"".$viu->data[0]['inp'][$l]['intType']."\" name='".$viu->data[0]['pr'][$j]['inName']."' value='".$item['teqValue']."'><br>";
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                            echo "</div>";
                        }
                    }
                }
            }
        }
        ?>
        <div class="cpu">
            <h4>დამატებითი ინფორმაცია</h4><hr>
            <br>
            <span>ინვოისი: </span>
            <input type="file" name="invois"><br>
            <span>კომენტარი: </span>
            <textarea name="kom"><?php echo $viu->data[0]["chekb"][0]['kom']; ?></textarea><br>
            <input type="submit" value="რედაქტირება" name="red">
            <input type="submit" value="აქტივაცია" name="active">
        </div>
    </form>

<?php }
if(isset($viu->data[0]['chat'])) {
    foreach ($viu->data[0]['chat'] as $chatitem) {
        echo "<b>" . $chatitem['name'] . " : </b>" . $chatitem['text'] . "<br>";
    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <label>ჩატი: (პასუხის მისაწერად დააკლიკეთ ჩატის გაგზავნა)</label><br>
    <textarea name="chat"></textarea><br>
    <input type="submit" value="ჩატის გაგზავნა">
</form>
<!--
<section>
    <div class="pcseting">
        <?php //require_once 'views/productSeting/pc.php';?>
    </div>
    <div class="leptopseting">
        <?php //require_once 'views/productSeting/leptop.php';?>
    </div>
</section>
-->
<?php } ?>