<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Data</h4>
                    <form class="forms-sample submit-form" action="<?php echo base_url('wikimedia/AddNewArticles') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="img" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary mr-2" value="Submit">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    ///Submit Form 
    $('.submit-form').submit(function(e) {
        e.preventDefault();
        e.stopPropagation();
        var formData = new FormData(this);
        let url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':
                        showSuccessSwal(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);
                        break;
                    case 'warning':
                        showWarningSwal(res.message);
                        break;
                    case 'error':
                        res.message.forEach(function(error) {
                            $('[name=' + error[0] + ']').parent().append('<span style="color:red; font-size:11px">' + error[1] + '</span>');
                        })
                        break;


                }
            }

        });
    })
</script>