<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data table</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="articles" class="table">
                                    <thead>
                                        <tr>
                                            <th>Article #</th>
                                            <th>Description</th>
                                            <th>Image</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#articles').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo base_url('wikimedia/get_articles_list_table') ?>',
                type: 'POST',
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'files'
                },

            ],
        });
    });
</script>