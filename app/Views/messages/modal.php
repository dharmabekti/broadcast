<!-- Modal Insert & Update -->
<div class="modal fade" id="modal-data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <input type="text" id="idData" hidden>
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Messages</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <textarea type="text" class="form-control" id="message" rows="15" required></textarea>
                </div>
                <div class="form-text">
                    Usable variables: <b>{{fullname}}</b><br>
                    For <b>BOLD</b> characters, please add <b>*...*</b> to the character<br>
                    For <i>ITALIC</i> characters, please add <b>_ ... _</b> to the character<br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalClose()">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveData() {
        id = $('#idData').val()
        message = $('#message').val()

        if (message == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: "Please complete the data!",
                showConfirmButton: false,
                timer: 3000
            })
        } else {
            $.ajax({
                url: "<?= base_url('msg') ?>",
                type: "post",
                data: {
                    "id": id,
                    "message": message,
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
</script>