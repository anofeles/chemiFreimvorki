<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="http://intranet.tsu.ge/grantebi/index.php/home/sheuft/" class="logo"><img src="http://intranet.tsu.ge/grantebi/images/invois/Picture2.png" width="50"></a>
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
            <div class="sat">


                <?php echo $_SESSION['userinfo']['Sename'] . " " . $_SESSION['userinfo']['Grname']; ?>

            </div>
            <ul class="nav navbar-nav navbar-right pull-right">
                <li class="dropdown top-menu-item-xs">
                    <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown"
                       aria-expanded="true"><?php echo $_SESSION['userinfo']['Fname'] . " " . $_SESSION['userinfo']['Sname']; ?></a>
                </li><li><a href='?aut=1'><i class='ti-power-off m-r-10 text-danger'></i> გასვლა</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <?php
            if(isset($viu->data[0]['grnid'])){
            foreach ($viu->data[0]['grnid'] as $datum) {
                        echo "<ul>
                <li class='has_sub'>
                    <a href='javascript:void(0);' class='waves-effect'><span>" . $datum['GrantName']  . " </span><span class='menu-arrow'></span></a><ul>";
                      foreach ($viu->data[0]["gweril"] as $grtum) {
                                echo "<li><a href='" . $viu->urlbase . "/home/sheuft/" . $grtum['workerID'] . "/" . $grtum['id']."' class='waves-effect'><span>" . $grtum['workerUser'] . "</span></a></li>";
                        }
                        echo "</ul>";
                echo "</li>
            </ul>";
            }
            }
            ?>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php
            if (isset($viu->data[0]['grnameviu'][0]['GrantName'])) {
                foreach ($viu->data[0]['gweril'] as $grniditem) {
                    if($grniditem['id'] == $viu->data[0]['werid'] && $grniditem['workerID'] == $viu->data[0]['grantid']) {
                        echo "<div class='row'>
                <div class='col-sm-12'>
                    <ol class='breadcrumb'>
                        <li>
                            <a href=''#'>".$viu->data[0]['grnameviu'][0]['GrantName']." ".$viu->data[0]['grnameviu'][0]['GrantN']."</a>
                        </li>
                        <li class='active'>
                            " . $grniditem['workerUser'] . "
                        </li>
                    </ol>
                </div>
            </div>";
                        echo "<div class='grwer'>";
                        foreach ($viu->data[0]['dawer'] as $daweritem) {
                            if ($grniditem['id'] == $daweritem['werid']) {
                                foreach ($viu->data[0]['grusers'] as $pesoneitem) {
                                    if ($daweritem['perscode'] == $pesoneitem['PersCode']) {
                                        echo " <span>" . $pesoneitem['Sname'] . " " . $pesoneitem['Fname'] . "</span> 
                        <a href='" . $viu->urlbase . "/home/sheuft/" . $grniditem['workerID'] . "/" . $grniditem['id'] . "?peredit=" . $pesoneitem['PersCode'] . "' ><button class='wertanred'>რედაქტირება</button></a> 
                        <a href='" . $viu->urlbase . "/home/sheuft/" . $grniditem['workerID'] . "/" . $grniditem['id'] . "?persdell=" . $pesoneitem['PersCode'] . "'><button class='wertandel'>წაშლა</button></a><br>";
                                    }
                                }
                            }
                        }
                        if (isset($viu->data[0]['werid']) && !isset($viu->data[0]['persdell']) && $grniditem ["id"] == $viu->data[0]['werid']) {
                            if (isset($viu->data[0]['edit'])) {
                                $pedit = "gusepersedit";
                            } else {
                                $pedit = "gusepers";
                            }
                            echo "
        <form action='" . $viu->urlbase . "/home/sheuft/" . $grniditem['workerID'] . "/" . $grniditem['id'] . "' method='post' >
        <input type='hidden' value='" . $viu->data[0]['grid'] . "' name='grid'>
        <input type='hidden' value='" . $viu->data[0]['werid'] . "' name='werrid'>
        <b>შემსრულებელის არჩევა</b>
<select name='$pedit'>
<option value='0'>არჩევა</option>";
                            foreach ($viu->data[0]['grusers'] as $gruser) {
                                if (isset($viu->data[0]['edit']) && $viu->data[0]['edit'] == $gruser['PersCode']) {
                                    $sel = "selected=\"selected\"";
                                } else {
                                    $sel = " ";
                                }
                                echo "<option $sel value='" . $gruser['PersCode'] . "'>" . $gruser['Sname'] . " " . $gruser['Fname'] . "</option>";
                            }
                            echo "</select>
<input type='submit' value='მიმაგრება'>
</form>";
                        }
                    }
                }
                echo "<hr>";
                foreach ($viu->data[0]['grvtitle'] as $item) {
                    echo " <a href='" . $viu->urlbase . "/home/sheuft/" . $viu->data[0]['grantid'] . "/" . $viu->data[0]['werid'] . "?red=".$item['kontaqt']."&incode=1'>".$item['title']."</a> ";
                }
                if (isset($_GET['incode'])) {
                    echo "<section>";
                    $invrao = count($viu->data[0]['inv']);
                    $prodrao = count($viu->data[0]['prod']);
                    $pr = count($viu->data[0]['pr']);
                    $inp = count($viu->data[0]['inp']);
                    echo "<form action='' method='post' enctype='multipart/form-data'>";
                    for ($i = 0; $i < $invrao; $i++) {
                        if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['incode']) {
                            echo "<h2>" . $viu->data[0]['inv'][$i]['proName'] . "</h2>";
                            for ($k = 0; $k < $prodrao; $k++) {
                                if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv'][$i]['invCode']) {
                                    echo "<div class='cpu'>";
                                    echo "<div class='nawtitle'><h4>" . $viu->data[0]['prod'][$k]['proName'] . "</h4></div><hr>";
                                    for ($j = 0; $j < $pr; $j++) {
                                        if ($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']) {
                                            echo "<table ><tr><td width='200'><span>" . $viu->data[0]['pr'][$j]['proSetName'] . "</span></td>";
                                            for ($l = 0; $l < $inp; $l++) {
                                                if ($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']) {
                                                    foreach ($viu->data[0]['grformedit'] as $item) {
                                                        if ($item['invCode'] == $viu->data[0]['inv'][$i]['invCode'] && $item['proCode'] == $viu->data[0]['pr'][$j]['proCode'] && $item['prSetCode'] == $viu->data[0]['pr'][$j]['proSetCode']) {

                                                            if ($item['teqValue'] == "on") {
                                                                $chek = "checked='checked'";
                                                            }
                                                            if ($item['teqValue'] != "on") {
                                                                $chek = "";
                                                            }
                                                            $wordText = $viu->data[0]['pr'][$j]['proSetName']." ".$item['teqValue'];
                                                            // echo "<input disabled='disabled' type='hidden' value='" . $item['id'] . "' name='" . $viu->data[0]['pr'][$j]['inName'] . "'>";
                                                            echo "<td><input disabled='disabled' " . $chek . " type='" . $viu->data[0]['inp'][$l]['intType'] . "' value='" . $item['teqValue'] . "'></td>";
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
                        }
                    }
                    echo "</section>";
                }
            }
            ?>
            <footer class="footer">
                © 2016. All rights reserved.
            </footer>
        </div>
    </div>
</div>
