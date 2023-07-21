<!-- Modal Insert & Update -->
<div class="modal fade" id="modal-data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <input type="text" id="idData" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Recipient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="fullname" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">WhatsApp Number</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Country Code" id="country" required
                            autocomplete="off">
                        <input type="text" class="form-control" placeholder="WhatsApp Number" id="phone" required
                            autocomplete="off">
                    </div>
                    <div class="form-text">Country Code (ex. 62 for Indonesian)<br>WhatsApp Number
                        (ex.
                        851-XXXX-XXXX)</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalClose()">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="formImport">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Recipient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="file" class="col-sm-3 col-form-label">File Excel</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="file" accept=".xls,.xlsx" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function saveData() {
    id = $('#idData').val()
    fullname = $('#fullname').val()
    country = $('#country').val()
    phone = $('#phone').val()

    if (fullname == "" || country == "" || phone == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "Please complete the data!",
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        $.ajax({
            url: "<?= base_url('') ?>",
            type: "post",
            data: {
                "id": id,
                "fullname": fullname,
                "country_code": country,
                "phone": phone,
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
}

$('#formImport').submit(function(e) {
    e.preventDefault();
    swal.fire({
        title: "Confirmation",
        text: "Are you sure to import data?",
        icon: "question",
        confirmButtonText: "Yes",
        showCancelButton: true,
    }).then((confirm) => {
        if (confirm.isConfirmed) {
            $.ajax({
                url: "<?= base_url('import') ?>",
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: true,
                async: false,
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
                error: function(result) {},
            });
        }
    });

});
</script>