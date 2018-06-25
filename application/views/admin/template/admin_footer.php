
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/jquery-1.12.3.js"></script>
<script src="<?php echo base_url() ?>adminassets/js/plugins/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>adminassets/js/plugins/morris.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>adminassets/js/plugins/wow.js"></script>
<script src="<?php echo base_url()?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>adminassets/js/admin_custom.js" type="text/javascript"></script>
<!-- Input tags -->
<script src="<?php echo base_url('plugins/jquery.tagsinput/src/jquery.tagsinput.js')?>"></script>

<script>
    /*$('.input-daterange input').each(function() {
     $(this).datepicker('');


     });*/

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>


<!-- jQuery Tags Input -->
<script>
    function onAddTag(tag) {
        alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
    }

    $(document).ready(function() {
        $('#tags_1').tagsInput({
            width: 'auto'
        });
    });
</script>
