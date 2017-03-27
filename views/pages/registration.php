<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><strong class="text-custom">გრანტების მოთხოვნის ტექნიკური მხარე</strong> </h3>
        </div>

        <div class="panel-body">
        
            <form class="form-horizontal m-t-20" action="<?php echo $viu->urlbase; ?>/home/registration" method="post">

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="user" class="form-control" type="text" required="" placeholder="saxeli">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="gvar" class="form-control" type="text" required="" placeholder="gvari">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="email" class="form-control" type="email" required="" placeholder="e-mail">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="pnumb" class="form-control" type="text" required="" placeholder="piradi nomeri">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="moxmarebeli" class="form-control" type="text" required="" placeholder="saxeli">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="paroli" class="form-control" type="password" required="" placeholder="saxeli">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="dampers" class="form-control" type="text" placeholder="contact person">
                    </div>
                </div>
<!--
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" checked="checked">
                            <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                </div>
-->
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
                            Register
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center">
            <p>
                <a href="<?php echo $viu->urlbase; ?>/home/index" class="text-primary m-l-5"><b>ავტორიზაცია</b></a>
            </p>
        </div>
    </div>

</div>


<!--

<form action="<?php echo $viu->urlbase; ?>/home/registration"  method="post">
    <input type="text" name="user" placeholder="saxeli"><br>
    <input type="text" name="gvar" placeholder="gvari"><br>
    <input type="text" name="email" placeholder="e-mail"><br>
    <input type="text" name="pnumb" placeholder="piradi nomeri"><br>
    <input type="text" name="moxmarebeli" placeholder="saxeli"><br>
    <input type="password" name="paroli" placeholder="saxeli"><br>
    <input type="submit" value="registracia">
</form>
-->
<?php
if(isset($viu->data[0]['errorinfo'])){
    echo $viu->data[0]['errorinfo'];
}

?>