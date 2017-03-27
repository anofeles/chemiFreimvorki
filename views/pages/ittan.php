<?php

if (isset($_GET['doc']) && $_GET['doc'] == 1) {
    require 'setings/vendor/autoload.php';
    $phpWord = new  \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Sylfaen');
    $phpWord->setDefaultFontSize(14);
    $properties = $phpWord->getDocInfo();
    $properties->setCreator('My name');
    $properties->setCompany('My factory');
    $properties->setTitle('My title');
    $properties->setDescription('My description');
    $properties->setCategory('My category');
    $properties->setLastModifiedBy('My name');
    $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
    $properties->setSubject('My subject');
    $properties->setKeywords('my, key, word');
    $sectionStyle = array();
    $section = $phpWord->addSection($sectionStyle);



    if (isset($viu->data[0]['werval']) && !empty($viu->data[0]['werval'])) {
        foreach ($viu->data[0]['werval'] as $wervalitum) {

        }

        if (isset($viu->data[0]['wrid']) && !empty($viu->data[0]['wrid'])) {

            foreach ($viu->data[0]['grvtitle'] as $item) {

            }
            $invrao = count($viu->data[0]['inv']);
            $prodrao = count($viu->data[0]['prod']);
            $pr = count($viu->data[0]['pr']);
            $inp = count($viu->data[0]['inp']);


            if (isset($_GET['incode'])) {
                for ($i = 0; $i < $invrao; $i++) {
                    if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['incode']) {

                        for ($k = 0; $k < $prodrao; $k++) {
                            if ($viu->data[0]['prod'][$k]['invCode'] == $viu->data[0]['inv'][$i]['invCode']) {

                                $section->addText(htmlspecialchars($viu->data[0]['prod'][$k]['proName']),
                                    array('name' => 'Sylfaen', 'size' => 26, 'color' => '075776', 'bold' => TRUE, 'italic' => TRUE),
                                    array('align' => 'center', 'spaceBefore' => 10)
                                );

                                for ($j = 0; $j < $pr; $j++) {
                                    if ($viu->data[0]['pr'][$j]['proCode'] == $viu->data[0]['prod'][$k]['proCode']) {


                                        for ($l = 0; $l < $inp; $l++) {
                                            if ($viu->data[0]['inp'][$l]['typID'] == $viu->data[0]['pr'][$j]['inpTypeID']) {
                                                foreach ($viu->data[0]['grformedit'] as $item) {
                                                    if ($item['invCode'] == $viu->data[0]['inv'][$i]['invCode'] && $item['proCode'] == $viu->data[0]['pr'][$j]['proCode'] && $item['prSetCode'] == $viu->data[0]['pr'][$j]['proSetCode']) {
                                                        if (!empty($item['teqValue'])) {
                                                            if ($item['teqValue'] == "on") {
                                                                $chek = "კი";
                                                            }

                                                            if ($item['teqValue'] != "on") {
                                                                $chek = $item['teqValue'];
                                                            }
                                                            $wordText = $viu->data[0]['pr'][$j]['proSetName'] . " " . $chek;
                                                            $section->addText(htmlspecialchars($wordText),
                                                                array('name' => 'Sylfaen', 'size' => 16, 'color' => '000000', 'bold' => FALSE, 'italic' => TRUE),
                                                                array('align' => 'left', 'spaceBefore' => 10)
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . $wervalitum['workerName'] . '.docx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');

    $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $xmlWriter->save("php://output");
}
?>

<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="http://intranet.tsu.ge/grantebi/index.php/home/shestan/" class="logo"><img src="http://intranet.tsu.ge/grantebi/images/invois/Picture2.png" width="50"></a>
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
            <div class="satit">


                <?php  echo $_SESSION['userinfo']['Sename'] . "<br> " . $_SESSION['userinfo']['Grname']; ?>

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
</div>

<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">

            <?php

            foreach ($viu->data[0]['grant'] as $datum) {
                $werarq = new ittan();

                echo "<ul>
                <li class='has_sub'>";
                foreach ($viu->data[0]['grname'] as $gr =>  $grtum) {
                    $werarq->grantarq($_SESSION['ittan']['PersCode']);
                    if($werarq->grantarq[$gr]["grdas"] == 0) {

                        if($datum['grantID'] == $grtum['GrantID']) {
                            echo "<a href='javascript:void(0);' class='waves-effect'><span>" . $grtum['GrantName'] . " " . $grtum['GrantN'] . "</span><span class='menu-arrow'></span></a><ul>";
                            foreach ($viu->data[0]['werval'] as $g => $werval) {
                                if($datum['grantID'] == $werval['grantID']) {
                                    $werarq->teqarq($werval['grantID'], $werval['id']);
                                    if(isset($werarq->grvtitle[$g]["grdas"])) {
                                        echo "<li class='has_sub'><a href='javascript:void(0);' class='waves-effect'><span>" . $werval['workerName'] . "</span> <span class='menu-arrow'></span></a><ul style=''>";
                                        foreach ($viu->data[0]['grvtitle'] as $grvtitle) {
                                            if($grvtitle['grantID'] == $werval['grantID'] && $grvtitle['werID'] == $werval['id']) {
                                                if($grvtitle['grdas'] == 0) {
                                                    echo "<li><a href='" . $viu->urlbase . "/home/ittan/" . $grvtitle['grantID'] . "/" . $grvtitle['werID'] . "/?red=" . $grvtitle['kontaqt'] . "&incode=" . $grvtitle['invCode'] . "'><span>" . $grvtitle['title'] . "</span></a></li>";
                                                }
                                            }
                                        }
                                        echo "</ul></li>";
                                    }
                                }
                            }

                            echo "</ul>";
                        }
                    }
                }
                echo "</li>
            </ul>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <?php if(isset($_GET['incode'])){
            ?>
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><?php echo $viu->data[0]['grnameviu'][0]['GrantName']." ".$viu->data[0]['grnameviu'][0]['GrantN']; ?></a>
                        </li>
                        <li>
                            <a href="#"><?php echo $viu->data[0]['wertitlenameviu'][0]['workerName']; ?></a>
                        </li>
                        <li class="active">
                            <?php echo $viu->data[0]['worvedviutitle'][0]['title']; ?>
                        </li>
                    </ol>
                </div>
            </div>
            <section>
                <?php
                echo "გრანტის ხელმძღვანელი: <b>". $viu->data[0]['damx'][0]['name'] ." ". $viu->data[0]['damx'][0]['fname'] ."</b> დამხმარე პირი: <b>".$viu->data[0]['damx'][0]['sakpir']."</b>";
                $invrao = count($viu->data[0]['inv']);
                $prodrao = count($viu->data[0]['prod']);
                $pr = count($viu->data[0]['pr']);
                $inp = count($viu->data[0]['inp']);
                }
                if (isset($_GET['incode'])) {
                    echo "<form action='' method='post' enctype='multipart/form-data'>";
                    for ($i = 0; $i < $invrao; $i++) {
                        if ($viu->data[0]['inv'][$i]['invCode'] == $_GET['incode']) {
                            echo "<h2>" . $viu->data[0]['inv'][$i]['proName'] . "</h2><table border='0' cellpadding='0' cellspacing='0'><tr><td>";
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
                                                            echo "<td><input disabled='disabled' " . $chek . " type='" . $viu->data[0]['inp'][$l]['intType'] . "' value='" . $item['teqValue'] . "'>
                                                    <input type='checkbox' name='" . $item['id'] . "'></td>";
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
                <span>ინვოისი: <a href='http://intranet.tsu.ge/grantebi/images/invois/".$viu->data[0]["chekb"][0]["doc"]."'>".$viu->data[0]["chekb"][0]["doc"]."</a></span><br>
                <span>კომენტარი: </span><br>
                <textarea cols='55' disabled>".$viu->data[0]["chekb"][0]['kom']."</textarea><br>
            </div></td></tr></table>
            <a href='?red=".$_GET['red']."&incode=".$_GET['incode']."&doc=1'>DOC</a><br><hr>";

                    echo "<br><input type='submit' value='ატვირთვა'></form><br><hr>";

                    foreach ($viu->data[0]['chat'] as $chatdatum) {
                        echo "<b>".$chatdatum['name']." : </b>".$chatdatum['text']."<br><span class='chtdata'>".$chatdatum['tarigi']."</span><br>";
                    }
                    echo "<form action='#' method='post'>
<textarea  cols='55' name='chattext'></textarea>
<input type='hidden' name='grid' value='".$viu->data[0]["grid"]."'>
<input type='hidden' name='werid' value='".$viu->data[0]["wrid"]."'>
<input type='hidden' name='saxeli' value='".$_SESSION['userinfo']['Fname'] . " " . $_SESSION['userinfo']['Sname']."'>
<input type='hidden' name='cat' value='".$_GET['red']."'>
<br><input type='submit' value='მიწერა'>
</form><br><hr>";
                    
                }

                ?>
            </section>
            <footer class="footer">
                © 2016. All rights reserved.
            </footer>
        </div>
    </div>
    <!--  <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title"><b>Pagination</b></h4>
                        <p class="text-muted m-b-30 font-13">
                            include pagination in your FooTable.
                        </p>

                        <label class="form-inline">Show
                            <select id="demo-show-entries" class="form-control input-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                            entries
                        </label>
                        <table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-page-size="5">
                            <thead>
                            <tr>
                                <th data-toggle="true"> First Name</th>
                                <th data-hide="all"> Last Name</th>
                                <th data-hide="all"> Job Title</th>
                                <th data-hide="all"> DOB</th>
                                <th data-hide="all"> Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Isidra</td>
                                <td>Boudreaux</td>
                                <td>Traffic Court Referee</td>
                                <td>22 Jun 1972</td>
                                <td><span class="label label-table label-success">Active</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>/Right-bar -->