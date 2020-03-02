<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barang</title>
</head>
<body>
    <h1>Barang</h1>


    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
    <script>
      window.addEventListener("afterprint", function(){
        history.back();
      });
      $("#body_print").ready(function(){
        window.print();
      });
    </script>
</body>
</html>
