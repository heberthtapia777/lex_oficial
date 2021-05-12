<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>LEX | Tablero &amp; Web CMS</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../../assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../../assets/js/config.navbar-vertical.js"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
  
    <link href="../../vendors/choices/choices.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> <!-- Modificado y agregado -->
    <link href="../../vendors/dropzone/dropzone.min.css" rel="stylesheet">

    <link href="../../assets/css/lightbox.css" rel="stylesheet">
    <link href="../../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl" />
    <link href="../../assets/css/theme.min.css" rel="stylesheet" id="style-default" />

    

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="../../vendors/datatables/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../vendors/datatables/css/jquery-ui-1.10.4.custom.css">
    <link rel="stylesheet" type="text/css" href="../../vendors/gijgo/css/gijgo.css"/>

    <link rel="stylesheet" type="text/css" href="../../assets/css/myStyle.css" />

    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        linkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        linkRTL.setAttribute('disabled', true);
      }
    </script>