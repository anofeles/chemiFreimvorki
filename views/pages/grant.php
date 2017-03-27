<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="http://intranet.tsu.ge/grantebi/index.php/home/index" class="logo"><img src="http://intranet.tsu.ge/grantebi/images/invois/Picture2.png" width="50"></a>
            <!-- Image Logo here -->
            <!--<a href="index.html" class="logo">-->
            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
            <!--</a>-->
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <?php if (!isset($viu->data[0]['wernomeri'])) { ?><a href="#" data-modal-id="popup1">წერილის
                            დამატება</a> <?php }?>
                        <?php if (isset($viu->data[0]['wernomeri'])) { ?><a href="#" data-modal-id="popup2">წერილის
                            რედაქტირება</a> <a href='?weredel=<?php echo $viu->data[0]['weredit'][0]['id']; ?>'>
                                წაშლა</a><?php } ?>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown"
                           aria-expanded="true"><?php echo $_SESSION['usergrant'][0]['Fname'] . " " . $_SESSION['usergrant'][0]['Sname']; ?></a>
                       
                    </li><li><a href="?aut=1"><i class="ti-power-off m-r-10 text-danger"></i> გასვლა</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End <ul style=''>
                                <li><a href='javascript:void(0);'><span>Menu Level 2.1</span></a></li>
                                <li><a href='javascript:void(0);'><span>Menu Level 2.2</span></a></li>
                                <li><a href='javascript:void(0);'><span>Menu Level 2.3</span></a></li>
                            </ul>-->
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <?php

                foreach ($_SESSION['usergrant'] as $grmon) {

                    $grperid = intval($grmon['memberid']);
                    if ($grperid == 1) {

                        echo "<li class='has_sub' id='grant' value='" . $grmon['GrantID'] . "'>
                    <a href='javascript:void(0);' class='waves-effect'><span>" . $grmon['GrantName'] . " - " . $grmon['description'] ." ".$grmon['GrantN']." </span> <span class='menu-arrow'></span></a>
                    <ul>";
                        foreach ($viu->data[0]['grantviu'] as $item) {
                            if ($grmon['GrantID'] == $item['workerID']) {
                                $grid = $grmon['GrantID'];
                                echo "<li>
                            <a href='" . $viu->urlbase . "/home/grant/" . $grmon['GrantID'] . "/" . $item['id'] . "?weredit=" . $item['id'] . "' class='waves-effect'><span>" . $item['workerUser'] . "</span></a>
                        </li>";
                            }
                        }
                        echo "</ul>
                </li>";
                    }
                }
                ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End <a href="http://f.usemind.org/img/2/usemind.org_Stefan_Beutler_xg.jpg" title="Stefan Beutler"
               alt="Stefan Beutler" rel="shadowbox[Vacation]"><img
                        src="http://f.usemind.org/img/2/usemind.org_Stefan_Beutler_xg_t.jpg" style="float:left;"
                        width="80"/></a>-->
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php
            if (isset($viu->data[0]['weredit'][0]['id'])) {
                echo "<div class='shesgrnt'>";
                if(isset($_GET['cat'])){$invrao = count($viu->data[0]['inv']);}else{$invrao = 0;}
                $prodrao = count($viu->data[0]['prod']);
                $pr = count($viu->data[0]['pr']);
                $inp = count($viu->data[0]['inp']);
                echo "            <div class='row'>
                <div class='col-sm-12'>
                    <ol class='breadcrumb'>
                        <li>
                            <a href='http://intranet.tsu.ge/grantebi/index.php/home/index'>". $viu->data[0]['grnameviu'][0]['GrantName'].' '.$viu->data[0]['grnameviu'][0]['GrantN']."</a>
                        </li>
                        <li>
                            <a href='#'>". $viu->data[0]['wertitlenameviu'][0]['workerUser']."</a>
                        </li>
                    </ol>
                </div>
            </div>";
                foreach ($viu->data[0]['grvtitle'] as $item) {
                    echo "<b>რედაქტირება: </b><a href='?weredit=" . $viu->data[0]['weredit'][0]['id'] . "&red=" . $item['kontaqt'] . "&incode=" . $item['invCode'] . "'>" . $item['title'] . "</a> | <a href='?dell=" . $item['kontaqt'] . "&incode=" . $item['invCode'] . "'>წაშლა</a> <br> ";
                }

                foreach ($viu->data[0]['grgagz'] as $item) {
                   echo "" . $item['title'] . " გაგზავნილია ტენდერზე <br> ";
                }
                echo "</div>";
                echo "</div><Br>";
?>

                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="p-20">

            <?php
                echo"<select class='dynamic_select selectpicker' data-style=\"btn-white\">
                <option value='?weredit=" . $viu->data[0]['weredit'][0]['id'] . "&code=0'> </option>";
                foreach ($viu->data[0]['categori'] as $item)  {
                    if (isset($_GET['cat'])) {if ($_GET['cat'] == $item['catid']) {$sle = "selected='selected'";} else { $sle = " ";}} else {$sle = " ";}
                    echo " <option ".$sle." value='?weredit=" . $viu->data[0]['weredit'][0]['id'] . "&cat=" . $item['catid'] . "'>" . $item['categori'] . "</option>";
                }
                echo "</select><br>";

if(isset($_GET['cat'])) {
    echo "<select class='dynamic_select selectpicker' data-style=\"btn-white\">
                <option value='?weredit=" . $viu->data[0]['weredit'][0]['id'] . "&code=0'> </option>";
    for ($i = 0; $i < $invrao; $i++) {
        if (isset($_GET['code'])) {
            if ($_GET['code'] == $viu->data[0]['inv'][$i]['invCode']) {
                $sle = "selected='selected'";
            } else {
                $sle = " ";
            }
        } else {
            $sle = " ";
        }
        echo " <option " . $sle . " value='?weredit=" . $viu->data[0]['weredit'][0]['id'] . "&cat=".$_GET['cat']."&code=" . $viu->data[0]['inv'][$i]['invCode'] . "'>" . $viu->data[0]['inv'][$i]['proName'] . "</option>";
    }
    echo "</select>";}
    ?>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php

                if (isset($_GET['code']) && $_GET['code'] > 0) {
                 echo "<section>   <form action = '' method = 'post' enctype = 'multipart/form-data' >
                    <label > სათაური: </label ><br >
                    <input type = 'text' name = 'fname' ><br >";

                        for ($i = 0; $i < $invrao; $i++) {
                            if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['code']) {
                                echo "<h2>" . $viu->data[0]['inv'][$i]['proName'] . "</h2>";
                                echo "<input type='hidden' value='" . $viu->data[0]['inv'][$i]['invCode'] . "' name='inv'><table border='0' cellpadding='0' cellspacing='0'><tr><td>";
                                for ($k = 0; $k < $prodrao; $k++) {
                                    if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv'][$i]['invCode']) {
                                        echo "<div class='cpu'>";
                                        echo "<br><div class='nawtitle'><h4>" . $viu->data[0]['prod'][$k]['proName'] . "</h4></div><br>";
                                        echo "<input type='hidden' value='" . $viu->data[0]['prod'][$k]['proCode'] . "' name='prod[]'>";
                                        for ($j = 0; $j < $pr; $j++) {
                                            if ($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']) {

                                                echo "<table ><tr><td width='200'><span>" . $viu->data[0]['pr'][$j]['proSetName'] . "</span>";
                                                echo "<input type='hidden' value='" . $viu->data[0]['pr'][$j]['proSetCode'] . "/" . $viu->data[0]['prod'][$k]['proCode'] . "' name='pr[]'></td>";
                                                for ($l = 0; $l < $inp; $l++) {
                                                    if ($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']) {
                                                        echo "<td><input type='" . $viu->data[0]['inp'][$l]['intType'] . "' name='" . $viu->data[0]['pr'][$j]['inName'] . "'></td>";
                                                    }
                                                }
                                                echo "</tr></table>";
                                            }
                                        }
                                        echo "</div>";
                                    }
                                }
                                echo "</td></tr>";
                            }
                        }

                   echo "<tr><td><div class='daminfo' >
                        <h4 > დამატებითი ინფორმაცია </h4 >
                        <span > ინვოისი: </span >
                        <input type = 'file' name = 'invois' >
                        <span > კომენტარი: </span ><br>
                        <textarea cols='55' ></textarea ><br >
                        <input type = 'submit' value = 'ატვირთვა' >
                        <input type = 'submit' value = 'აქტივაცია' name = 'active' >
                    </div ></td></tr></table>
                </form >  </section>";
             }
             if(isset($_GET['incode'])){
                 $invrao = count($viu->data[0]['inv1']);
                 $prodrao = count($viu->data[0]['prod']);
                 $pr = count($viu->data[0]['pr']);
                 $inp = count($viu->data[0]['inp']);

                 if (isset($_GET['incode'])) {
                     echo "<section><form action='' method='post' enctype='multipart/form-data'>";
                     for ($i = 0; $i < $invrao; $i++) {
                         if ($viu->data[0]['inv1'][$i]['invCode'] == $_GET['incode']) {
                             echo "<h2>" . $viu->data[0]['inv1'][$i]['proName'] . "</h2><table border='0' cellpadding='0' cellspacing='0'><tr><td>";
                             for ($k = 0; $k < $prodrao; $k++) {
                                 if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv1'][$i]['invCode']) {
                                     echo "<div class='cpu'>";
                                     echo "<div class='nawtitle'><h4>" . $viu->data[0]['prod'][$k]['proName'] . "</h4></div><hr>";

                                     for ($j = 0; $j < $pr; $j++) {
                                         if ($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']) {
                                             echo "<table ><tr><td width='200'><span>" . $viu->data[0]['pr'][$j]['proSetName'] . "</span></td>";
                                             echo "<input type='hidden' value='" . $viu->data[0]['pr'][$j]['proSetCode'] . "/" . $viu->data[0]['prod'][$k]['proCode'] . "' name='pr[]'></td>";
                                             echo "<input type='hidden' value='" . $viu->data[0]['prod'][$k]['proCode'] . "' name='prodedi[]' >";
                                             for ($l = 0; $l < $inp; $l++) {
                                                 if ($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']) {
                                                     foreach ($viu->data[0]['grformedit'] as $item) {
                                                         if ($item['invCode'] == $viu->data[0]['inv1'][$i]['invCode'] && $item['proCode'] == $viu->data[0]['pr'][$j]['proCode'] && $item['prSetCode'] == $viu->data[0]['pr'][$j]['proSetCode']) {
                                                             if ($item['teqValue'] == "on") {
                                                                 $chek = "checked='checked'";
                                                             }
                                                             if ($item['teqValue'] != "on") {
                                                                 $chek = "";
                                                             }
                                                             $wordText = $viu->data[0]['pr'][$j]['proSetName']." ".$item['teqValue'];

                                                                 if($item['editinp'] == 1 && $item['active'] == 0){
                                                                     $varsk = "<b style='color: #8B0000'>*</b>";
                                                                 }
                                                                 else{ $varsk = " ";}

                                                              echo "<td><input type='hidden' value='" . $item['id'] . "' name='".$viu->data[0]['pr'][$j]['inName']."1' >";
                                                             echo "<input  " . $chek . " type='" . $viu->data[0]['inp'][$l]['intType'] . "' value='".$item['teqValue']."' name='" . $viu->data[0]['pr'][$j]['inName'] . "'> $varsk </td>";
                                                         }
                                                     }
                                                 }
                                             }
                                             echo "</tr></table>";
                                         }
                                     }
                                     echo "</div>";
                                 }
                             }
                             echo "</td></tr>";
                         }
                     }

                     echo "<tr><td><div class='cpu'>
                <div class='nawtitle'<h4>დამატებითი ინფორმაცია</h4></div><hr>
                <br>
                <span>ინვოისი: <a href='http://intranet.tsu.ge/grantebi/images/invois/".$viu->data[0]["chekb"][0]["doc"]."'>".$viu->data[0]["chekb"][0]["doc"]."</a></span><br><input name='invois' type='file'>
                <span>კომენტარი: </span><br>
                <textarea cols='55' name='kom' >".$viu->data[0]["chekb"][0]['kom']."</textarea><br>
            <input type = 'submit' value = 'ატვირთვა' name='updateteqn'>
                        <input type = 'submit' value = 'აქტივაცია' name = 'active' ></div></td></tr></table></form>";
if(isset($viu->data[0]['chat'])) {
    foreach ($viu->data[0]['chat'] as $chatdatum) {
        echo "<b>" . $chatdatum['name'] . " : </b>" . $chatdatum['text'] . " <br> <span class='chtdata'>" . $chatdatum['tarigi'] . "</span><br>";
    }
}
                     echo "<br><form action='' method='post' enctype='multipart/form-data'><textarea name='chat'></textarea><br><input type='submit' value='ატვირთვა' ></form></section>";

                 }
             }
            }
            ?>
            <!------------------------------------------------------------------------------------>
            <div id="popup1" class="modal-box">
                <div class="modal-body">
                    <p>
                        <?php echo "
                   <div class='panel-body'>
    <form action='" . $viu->urlbase . "/home/worker' method='post'>
            <div class='form-group '>
                    <div class='col-xs-12'>
        <select name='grantmonac' class='worgrmonac'>";
                        foreach ($_SESSION['usergrant'] as $item) {
                            if($item['description'] == "პროექტის ხელმძღვანელი"){
                           echo "<option value='".$item['GrantID']."'>".$item['GrantName']." </option>";
                            }
                        }

       echo " </select><br>
        </div>
        </div>
          <div class='form-group '>
                    <div class='col-xs-12'>
        <input  class='form-control' type='text' name='wnumb' placeholder='წერილის ნომერი'>
        </div>
        </div>
          <div class='form-group '>
                    <div class='col-xs-12'>
        <input  class='form-control' type='text' name='name' placeholder='სამუშაო გარემოს დასახელება'>
        </div>
        </div>
           <div class='form-group text-center m-t-40'>
                    <div class='col-xs-12'>
                        <button class='btn btn-pink btn-block text-uppercase waves-effect waves-light' type='submit'>
                            წერილის შედგენა
                        </button>
                    </div>
                </div>
    </form>
    </div>"; ?>
                    </p>
                </div>
                <footer><a href="#" class="btn btn-small js-modal-close">Close</a></footer>
            </div>

            <div id="popup2" class="modal-box">
                <div class="modal-body">
                    <p>
                        <?php echo "
                   <div class='panel-body'>
    <form action='" . $viu->urlbase . "/home/worker' method='post'>
          <div class='form-group '>
                    <div class='col-xs-12'>
        <input  class='form-control' type='text' name='wnumbedit' value='" . $viu->data[0]['weredit'][0]['workerUser'] . "'>
        </div>
        </div>
        <input type='hidden' name='pc' value='" . $viu->data[0]['grid'] . "'>
        <input type='hidden' name='werid' value='" . $viu->data[0]['weredit'][0]['id'] . "'>
          <div class='form-group '>
                    <div class='col-xs-12'>
        <input  class='form-control' type='text' name='name' value='" . $viu->data[0]['weredit'][0]['workerName'] . "'>
        </div>
        </div>
           <div class='form-group text-center m-t-40'>
                    <div class='col-xs-12'>
                        <button class='btn btn-pink btn-block text-uppercase waves-effect waves-light' type='submit'>
                            წერილის შედგენა
                        </button>
                    </div>
                </div>
    </form>
    </div>"; ?>
                    </p>
                </div>
                <footer><a href="#" class="btn btn-small js-modal-close">Close</a></footer>
            </div>
        </div>

    </div>
</div>

<br><br><br><br>

