
<?php
/*
echo "<select class='teq'><option value='0' selected='selected'>აირჩიეთ ტექნიკა</option>";
foreach ($viu->data[0]['info'] as $testItems) {
    echo "<option value='" . $testItems['proid'] . "'>" . $testItems['title'] . "</option>";
}
echo "</select>";

<div class='login'>
    <form action='" . $viu->urlbase . "/home/login' method='post'>
        <input type='text' name='user' placeholder='მომხამრებელი'><br>
        <input type='password' name='pass' placeholder='პაროლი'><br>
        <input type='submit' value='shesvla'>
    </form>
    <br><a href='" . $viu->urlbase . "/home/registration'><button class='regb'>registracia</button></a>
    </div>

         <div class='form-group '>
                    <div class='col-xs-12'>
                        <div class='checkbox checkbox-primary'>
                            <input id='checkbox-signup' type='checkbox'>
                            <label for='checkbox-signup'>
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>
*/



if (!isset($_SESSION['userinfo']['Fname']) && !isset($_SESSION['usergrant']) && !isset($_SESSION['sheuft']) && !isset($_SESSION['shestan']) ) {

    echo "
<div class='account-pages'></div>
<div class='clearfix'></div>
<div class='wrapper-page'>
    <div class=' card-box'>
        <div class='panel-heading'>
            <h3 class='text-center'><strong class='text-custom'>გრანტების მოთხოვნის ტექნიკური მხარე</strong> </h3>
        </div>


        <div class='panel-body'>
            <form class='form-horizontal m-t-20' method='post' action='" . $viu->urlbase . "/home/login'>

                <div class='form-group '>
                    <div class='col-xs-12'>
                        <input name='user' class='form-control' type='text' required='' placeholder='მომხამრებელი'>
                    </div>
                </div>

                <div class='form-group'>
                    <div class='col-xs-12'>
                        <input name='pass' class='form-control' type='password' required='' placeholder='პაროლი'>
                    </div>
                </div>


                <div class='form-group text-center m-t-40'>
                    <div class='col-xs-12'>
                        <button class='btn btn-pink btn-block text-uppercase waves-effect waves-light' type='submit'>Log In</button>
                    </div>
                </div>


            </form>

        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12 text-center'>
            <p><a href='" . $viu->urlbase . "/home/registration' class='text-primary m-l-5'><b>რეგისტრაცია</b></a></p>
        </div>
    </div>

</div>";

} else {
   // var_dump($_SESSION['ittan']);
    if (isset($_SESSION['usergrant'])) {
        header('Location: http://intranet.tsu.ge/grantebi/index.php/home/grant');
    }
    else if (isset($_SESSION['sheuft'])){
        header('Location: http://intranet.tsu.ge/grantebi/index.php/home/sheuft');
        
    }
    else if (isset($_SESSION['shestan'])){
        header('Location: http://intranet.tsu.ge/grantebi/index.php/home/shestan');
    }
    else if(isset($_SESSION['ittan'])){
        header('Location: http://intranet.tsu.ge/grantebi/index.php/home/ittan');
    }
    else{
        echo "
<div class='account-pages'></div>
<div class='clearfix'></div>
<div class='wrapper-page'>
    <div class=' card-box'>
        <div class='panel-heading'>
            <h3 class='text-center'> <strong class='text-custom'>გრანტების მოთხოვნის ტექნიკური მხარე</strong> </h3>
        </div>


        <div class='panel-body'>
            <form class='form-horizontal m-t-20' method='post' action='" . $viu->urlbase . "/home/login'>

                <div class='form-group '>
                    <div class='col-xs-12'>
                        <input name='user' class='form-control' type='text' required='' placeholder='მომხამრებელი'>
                    </div>
                </div>

                <div class='form-group'>
                    <div class='col-xs-12'>
                        <input name='pass' class='form-control' type='password' required='' placeholder='პაროლი'>
                    </div>
                </div>

      

                <div class='form-group text-center m-t-40'>
                    <div class='col-xs-12'>
                        <button class='btn btn-pink btn-block text-uppercase waves-effect waves-light' type='submit'>Log In</button>
                    </div>
                </div>

                <div class='form-group m-t-30 m-b-0'>
                    <div class='col-sm-12'>
                        <a href='page-recoverpw.html' class='text-dark'><i class='fa fa-lock m-r-5'></i> Forgot your password?</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class='row'>
        <div class='col-sm-12 text-center'>
            <p>Don't have an account? <a href='" . $viu->urlbase . "/home/registration' class='text-primary m-l-5'><b>Sign Up</b></a></p>
        </div>
    </div>

</div>";
    }

}
?>
