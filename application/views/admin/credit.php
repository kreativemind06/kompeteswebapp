<div class="main_body">
    <!-- add user modal start -->
    <!-- user content section -->
    <div class="theme_wrapper">
        <div class="container-fluid">



            <div class="theme_section">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="th_manage_user">
                            <h3 class="th_title">Transaction History</h3>
                            <div class="table-responsive">
                                <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Credit Unit</th>
                                        <th>Price Per Unit (£)</th>
                                        <th>Credit Prices (£)</th>
                                        <th>Action</th>
                                    </tr>
                                    <thead>
                                    <tfoot>
                                    <tr>

                                        <th>Credit Unit</th>
                                        <th>Price Per Unit (£)</th>
                                        <th>Credit Prices (£)</th>
                                        <th>Action</th>
                                    </tr>
                                    <tfoot>
                                    <tbody>

                                    <?php foreach($creditPrice as $row):?>
                                        <tr id="<?php echo $row['id']; ?>">
                                            <td data-target="creditUnit"> <?php echo $row['credit_unit']; ?></td>
                                            <td data-target="price_per_credit"><?php echo $row['price_per_credit']; ?></td>
                                            <td data-target="creditPrice"><?php echo $row['credit_price']; ?></td>
                                            <td><a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">Update</a></td>
                                        </tr>
                                    <?php endforeach ?>

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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Credit Unit</label>
                    <input type="text" id="creditUnit" class="form-control">
                </div>
                <div class="form-group">
                    <label>Total Credit Price (£)</label>
                    <input type="text" id="creditPrice" class="form-control">
                </div>

                <div class="form-group">
                    <label hidden>Price Per Unit (£)</label>
                    <input type="hidden" id="price_per_credit" class="form-control">
                </div>
                <input type="hidden" id="userId" class="form-control">


            </div>
            <div class="modal-footer">
                <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/jquery-1.12.3.js"></script>
<script src="<?php echo base_url() ?>adminassets/js/plugins/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>adminassets/js/plugins/morris.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/plugins/wow.js"></script>
<script src="<?php echo base_url()?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>adminassets/js/admin_custom.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){

        //  append values in input fields
        $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var creditUnit  = $('#'+id).children('td[data-target=creditUnit]').text();
            var creditPrice  = $('#'+id).children('td[data-target=creditPrice]').text();
            var price_per_credit  = $('#'+id).children('td[data-target=price_per_credit]').text();

            $('#creditUnit').val(creditUnit);
            $('#creditPrice').val(creditPrice);
            $('#price_per_credit').val(price_per_credit);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
        });

        // now create event to get data from fields and update in database

        $('#save').click(function(){
            var id  = $('#userId').val();
            var creditUnit =  $('#creditUnit').val();
            var creditPrice =  $('#creditPrice').val();
            var price_per_credit =   $('#price_per_credit').val();

            $.ajax({
                url      : '<?php //echo base_url('admin/credit')?>',
                method   : 'post',
                data     : {creditUnit : creditUnit , creditPrice: creditPrice , price_per_credit : price_per_credit , id: id},
                success  : function(response){
                    // now update user record in table
                    $('#'+id).children('td[data-target=firstName]').text(creditUnit);
                    $('#'+id).children('td[data-target=lastName]').text(creditPrice);
                    $('#'+id).children('td[data-target=price_per_credit]').text(price_per_credit);
                    $('#myModal').modal('toggle');
                }
            });
        });
    });
</script>