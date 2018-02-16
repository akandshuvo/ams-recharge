  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/labaid/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/labaid/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/labaid/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="/labaid/plugins/datatables/dataTables.bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <!--Jquery Autocomplete-->  
  <!-- JS file -->
  <script src="/labaid/dist/js/jquery.easy-autocomplete.min.js"></script> 
  
  <!-- CSS file -->
  <link rel="stylesheet" href="/labaid/dist/css/easy-autocomplete.min.css"> 
  
  <!-- Additional CSS Themes file - not required-->
  <link rel="stylesheet" href="/labaid/dist/css/easy-autocomplete.themes.min.css"> 
  
<!--sweetalert-->  
  <script src="/labaid/dist/js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/labaid/dist/css/sweetalert.css">

<!--Pnotify-->  
  <script src="/labaid/dist/js/pnotify.custom.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/labaid/dist/css/pnotify.custom.min.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
    body {
      overflow-y: hidden !important;
    }
    /* Preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #fff;
      /* change if the mask should have another color then white */
      z-index: 99;
      /* makes sure it stays on top */
    }
    #status {
      width: 200px;
      height: 200px;
      position: absolute;
      left: 50%;
      /* centers the loading animation horizontally one the screen */
      top: 50%;
      /* centers the loading animation vertically one the screen */
      background-image: url(https://www.createwebsite.net/wp-content/uploads/2015/09/Loader.gif);
      /* path to your loading animation */
      background-repeat: no-repeat;
      background-position: center;
      margin: -100px 0 0 -100px;
      /* is width and height divided by two */
    }
</style>

<script>

  $(window).on('load', function() { // makes sure the whole site is loaded 
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').delay(1000).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(1000).css({'overflow':'visible'});
  })

</script>