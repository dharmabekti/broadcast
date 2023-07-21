<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="float-sm-start">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-data">Tambah</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalImport">Import</button>
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
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($recipients as $item) : ?>
                <tr>
                    <th scope="row"><?= $no ?></th>
                    <td><?= $item->name ?></td>
                    <td><?= $item->country_code . $item->number ?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                            <button class="btn btn-outline-primary btn-sm"
                                onclick="sendMessage('<?= $item->id ?>','<?= $item->name ?>')">Send Message</button>
                            <button class="btn btn-outline-dark btn-sm"
                                onclick="editRecipient('<?= $item->id ?>','<?= $item->name ?>','<?= $item->country_code ?>','<?= $item->number ?>')">Edit</button>
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="deleteRecipient('<?= $item->id ?>','<?= $item->name ?>')">Delete</button>
                        </div>
                    </td>
                </tr>
                <?php $no++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<?= $this->include('recipients/modal') ?>

<script>
function modalClose() {
    $('#idData').val("")
    $('#fullname').val("")
    $('#country').val("")
    $('#phone').val("")
    $('#modal-data').modal('hide')
}

function sendMessage(id, name) {
    swal.fire({
        title: "Confirmation",
        text: `Are you sure to send message to ${name} ?`,
        icon: "question",
        confirmButtonText: "Yes",
        showCancelButton: true,
    }).then((confirm) => {
        if (confirm.isConfirmed) {
            $.ajax({
                url: "<?= base_url('send') ?>",
                type: "post",
                data: {
                    "id": id,
                },
                success: function(result) {
                    res = JSON.parse(result)
                    console.log(res.id);
                    Swal.fire({
                        icon: res.type,
                        title: res.status_message,
                        showConfirmButton: false,
                        timer: 3000
                    })
                },
                error: function(result) {
                    // swal_error(result);
                },
            });
        }
    });
}

function editRecipient(id, name, code, number) {
    $('#idData').val(id)
    $('#fullname').val(name)
    $('#country').val(code)
    $('#phone').val(number)
    $('#modal-data').modal('show')
}

function deleteRecipient(id, name) {
    swal.fire({
        title: "Confirmation",
        text: `Are sure to delete ${name} ?`,
        icon: "question",
        confirmButtonText: "Yes",
        showCancelButton: true,
    }).then((confirm) => {
        if (confirm.isConfirmed) {
            $.ajax({
                url: "<?= base_url('') ?>" + id,
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
</script>
<?= $this->endSection() ?>