<?php
require '../class/connect.php';

$sql = "SELECT n.id,n.title,n.category, date_format(n.created_date, '%d-%m-%Y') as tarikh, a.name "
        . "FROM news n "
        . "LEFT JOIN admin a on a.username=n.created_by;";

$result = mysqli_query($link, $sql);
?>
<table class="table table-bordered" cellspacing="0" width="100%" id="bookingTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Uploaded By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Title</th>
            <th>Category</th>
            <th>Uploaded By</th>
            <th>Action</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        while ($obj = mysqli_fetch_object($result)) {
            ?>
            <tr>
                <td ><?= $obj->id ?></td>
                <td ><?= $obj->tarikh ?></td>
                <td ><?= $obj->title ?></td>
                <td ><?= $obj->category ?></td>
                <td ><?= $obj->name ?></td>
                <td>
                    <input type="hidden" id="b_obj" value='<?= json_encode($obj) ?>'>
                    <div class="btn-group">

                        <span>
                            <button id="btnUpdateModal" type="button" class="btn btn-sm btn-success"><i class="fa fa-pencil-square"></i> Update</button>
                        </span>

                        <span>
                            <button id="btnDelete" type="button" class="btn btn-sm btn-danger" ><i class="fa fa-times"></i> Delete</button>
                        </span>

                    </div>
                </td>
            </tr>
            <?php
        }//end while
        ?>

    </tbody>
</table>

<script>
    $(function () {
        // Setup - add a text input to each footer cell
        $('#bookingTable tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input class="form-control" type="text" style="width:100%;" placeholder="Search ' + title + '" />');
        });

        var table = $('#bookingTable').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: ['copy',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {search: 'applied'}
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {search: 'applied'}
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {search: 'applied'}
                    }
                },
                'colvis'
            ]
        });

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });

        table.buttons().container()
                .appendTo('#bookingTable_wrapper .col-sm-6:eq(0)');
    });

</script>

