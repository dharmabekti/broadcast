<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broadcast Message</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div>
        <!-- Start Top Navigation Bar -->
        <?=$this->include('template/topbar')?>
        <!-- End Top Navigation Bar -->
    </div>
    <div><br>
        <!-- Start Body atau Content -->
        <?=$this->renderSection('content')?>
        <!-- End Body atau Content -->
    </div>
</body>

<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script>
new DataTable('#myTable', {
    responsive: true
});
</script>

</html>