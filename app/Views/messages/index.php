<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="float-sm-start">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-data">Tambah</button>
        </div>
    </div>
</div>
<br>
<hr>
<div class="container-fluid">
    <div class="table-responsive">
        <table id="myTable" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Message</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($msg as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $no ?></th>
                        <td><?= substr($item->message, 0, 30) ?></td>
                        <td><?= $item->status == 1 ? "Active" : "Inactive" ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button class="btn btn-outline-success btn-sm" onclick="activatedMsg('<?= $item->id ?>','<?= $item->status ?>')"><?= $item->status == 0 ? "Activated" : "Inactivated" ?></button>
                                <button class="btn btn-outline-dark btn-sm" onclick="editMsg('<?= $item->id ?>')">Edit</button>
                                <button class="btn btn-outline-danger btn-sm" onclick="deleteMsg('<?= $item->id ?>')">Delete</button>
                            </div>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<?= $this->include('messages/modal') ?>
<script>
    function modalClose() {
        $('#idData').val("")
        $('#message').val("")
        $('#modal-data').modal('hide')
    }

    function editMsg(id) {
        $.ajax({
            url: "<?= base_url('msg/') ?>" + id,
            type: "get",
            success: function(result) {
                res = JSON.parse(result)
                console.log(res.id);
                $('#idData').val(res.id)
                $('#message').val(res.message)
                $('#modal-data').modal('show')
            },
            error: function(result) {
                // swal_error(result);
            },
        });
    }

    function deleteMsg(id) {
        swal.fire({
            title: "Confirmation",
            text: `Are sure to delete this message?`,
            icon: "question",
            confirmButtonText: "Yes",
            showCancelButton: true,
        }).then((confirm) => {
            if (confirm.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('msg/') ?>" + id,
                    type: "delete",
                    success: function(result) {
                        res = JSON.parse(result)
                        console.log(res.id);
                        Swal.fire({
                            icon: res.type,
                            title: res.type,
                            text: res.message,
                            showConfirmButton: false,
                            timer: 3000
                        }).then(function() {
                            location.reload()
                        })
                    },
                    error: function(result) {
                        // swal_error(result);
                    },
                });
            }
        });
    }

    function activatedMsg(id, status) {
        $.ajax({
            url: "<?= base_url('msg/') ?>" + id,
            type: "post",
            data: {
                status: status
            },
            success: function(result) {
                res = JSON.parse(result)
                console.log(res.id);
                Swal.fire({
                    icon: res.type,
                    title: res.type,
                    text: res.message,
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    location.reload()
                })
            },
            error: function(result) {
                // swal_error(result);
            },
        });
    }
</script>
<?= $this->endSection() ?>