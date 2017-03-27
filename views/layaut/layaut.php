<!DOCTYPE html>
<html>

<!-- Mirrored from coderthemes.com/ubold_2.1/light-dark/tables-foo-tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jan 2017 07:05:57 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon_1.ico">

    <title>Ubold - Responsive Admin Dashboard Template</title>

    <link href="http://intranet.tsu.ge/grantebi/assets/plugins/footable/css/footable.core.css" rel="stylesheet">
    <!--Footable-->
    <link href="http://intranet.tsu.ge/grantebi/css/mycss.css" rel="stylesheet">
    <link href="http://intranet.tsu.ge/grantebi/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />

    <link href="http://intranet.tsu.ge/grantebi/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="http://intranet.tsu.ge/grantebi/assets/shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />
    <script src="http://intranet.tsu.ge/grantebi/assets/shadowbox/shadowbox.js"></script>
    <script type="text/javascript">
        Shadowbox.init({
            handleOversize: "drag",
            modal: true
        });
    </script>
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="http://intranet.tsu.ge/grantebi/assets/js/modernizr.min.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-69506598-1', 'auto');
        ga('send', 'pageview');
    </script>


    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.css" rel="stylesheet" type="text/css">

</head>

<body class="fixed-left">
<script type="text/javascript"><!--
                google_ad_client = "ca-pub-2783044520727903";
                /* jQuery_demo */
                google_ad_slot = "2780937993";
                google_ad_width = 728;
                google_ad_height = 90;
                //-->
            </script>
<!-- Begin page -->
<div id="wrapper">


    <!-- Top Bar End -->



    <!-- Left Sidebar End   -->
  <?php  require_once 'views/pages/'.$viu->data[0]['subview'].'.php'; ?>


</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->

<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.min.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/bootstrap.min.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/detect.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/fastclick.js"></script>

<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.slimscroll.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.blockUI.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/waves.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/wow.min.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.nicescroll.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.scrollTo.min.js"></script>


<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.core.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/js/jquery.app.js"></script>

<!--FooTable-->
<script src="http://intranet.tsu.ge/grantebi/assets/plugins/footable/js/footable.all.min.js"></script>

<script src="http://intranet.tsu.ge/grantebi/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>

<!--FooTable Example-->
<script src="http://intranet.tsu.ge/grantebi/assets/pages/jquery.footable.js"></script>
<script src="http://intranet.tsu.ge/grantebi/js/myjs.js"></script>

<!-- Mirrored from coderthemes.com/ubold_2.1/light-dark/tables-foo-tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jan 2017 07:05:58 GMT -->

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(function(){

        var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

        $('a[data-modal-id]').click(function(e) {
            e.preventDefault();
            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);
            //$(".js-modalbox").fadeIn(500);
            var modalBox = $(this).attr('data-modal-id');
            $('#'+modalBox).fadeIn($(this).data());
        });


        $(".js-modal-close, .modal-overlay").click(function() {
            $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
            });

        });

        $(window).resize(function() {
            $(".modal-box").css({
                top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            });
        });

        $(window).resize();

    });
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>









<script src="http://intranet.tsu.ge/grantebi/assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="http://intranet.tsu.ge/grantebi/assets/plugins/tiny-editable/numeric-input-example.js"></script>


<script src="http://intranet.tsu.ge/grantebi/assets/pages/datatables.editable.init.js"></script>

<script>
    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();

</script>


</body>
</html>





<!-- <script src="http://intranet.tsu.ge/grantebi/assets/pages/jquery.footable.js"></script> -->

