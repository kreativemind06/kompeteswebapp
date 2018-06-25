<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/dropzone.css">
<style type="text/css">
    .borderNone{
        border: none !important;
    }

    .tagsinput {
        border: 1px solid #ccc;
        background: #fff;
        padding: 6px 6px 0;
        width: 300px;
        overflow-y: auto;
    }
    span.tag {

        display: block;
        float: left;
        padding: 0px 5px 0px 5px;
        text-decoration: none;
        /*background: #1abb9c;*/
        background: #c02f21;
        color: #f1f6f7;
        margin-right: 5px;
        font-weight: 500;
        margin-bottom: 5px;
        font-family: helvetica;
    }
    span.tag a {
        color: #f1f6f7 !important;
    }
    .tagsinput span.tag a {
        font-weight: bold;
        color: #82ad2b;
        text-decoration: none;
        font-size: 11px;
    }
    .tagsinput input {
        width: 80px;
        margin: 0px;
        font-family: helvetica;
        font-size: 12px;
        border: 1px solid transparent;
        padding: 3px;
        background: transparent;
        color: #000;
        outline: 0px;
    }
    .tagsinput div {
        display: block;
        float: left;
    }
    .tags_clear {
        clear: both;
        width: 100%;
        height: 0px;
    }
    .not_valid {
        background: #fbd8db !important;
        color: #90111a !important;
    }
</style>


<section  class="content" style="margin-top: 90px;padding: 0;">

    <div class="container-fluid no-margin-xs no-padding-xs" style="">

        <div class="col-sm-10 col-sm-offset-1 no-margin-xs no-padding-xs">

<div class="row text-center" style="min-height: 50px; margin-top: -32px;margin-bottom: 70px">
                <ul class="nav nav-tabs" style="width:;">
                    <li class="no-border-radius text-black f-s-20" style="width:;border-bottom: 2px solid #f00;width: 50%"><a href="<?php echo base_url('upload')?>" class="text-black"> Upload Photos </a> </li>
                    <li style="width:50%"><a href="<?php echo base_url('upload/video')?>" class="text-black f-s-20">Upload Videos </a> </li>
                </ul>
            </div>

            <?php echo $success ?>
            <div class="drop-zone-upload" style="margin-top: 40px">
                 <?php echo form_open_multipart('upload/upload_pix', array('class'=>"dropzone", 'id'=>"mydropzone"))?>
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                <?php echo form_close()?>
            </div>






            <div class="upload-info no-padding-xs" id="processUpload" hidden style="margin-top: 50px; background:#f2f2f2;padding:20px;">
                <?php echo form_open()?>
                <div class="uploaded-picture">
                    <h5 class="m-t-0 m-b-40" style="border-bottom: 1px solid #d2d2d2">Give information about the uploaded <span class="text-red"> Photos </span></h5>
                </div>


                    <div class="form-group col-sm-6">
                        <label>Title</label>
                        <input type="text" class="form-control no-border-radius" value="<?php echo set_value('title') ?>" name="title" placeholder="title">
                    </div>


                    <div class="form-group col-sm-6" style="min-height: 50px">
                        <label>Adult Content</label>
                        <div class="toggleWrapper" style="width: 100%; margin-top: 25px;position: relative">
                            <input class="dn" name="adult" value="yes" type="checkbox" id="dn"/>
                            <label class="toggle" for="dn"><span class="toggle__handler"></span></label>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Description</label>
                        <textarea class="form-control no-border-radius" name="discription"><?php echo set_value('discription')?></textarea>
                    </div>


                    <div class="form-group col-sm-6">


                        <div class="control-group">
                            <?php echo form_error('tags')?>
                            <label class="">Tags</label>
                            <div class="">
                                <input id="tags_1" type="text" class="tags form-control" name="tags" value="<?php echo set_value('tags','Prize Value, Abstract, Jury')?>"/>
                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>

                    </div>


                    <div class="form-group col-sm-12">
                        <label>Select Category(s)</label>

                        <div class="photo-cat">
                            <?php
                                $this->db->select('*');
                                $getCat = $this->db->get('category')->result_array();
                                foreach($getCat as $cat):
                            ?>
                            <div class="select-cat">
                                <input id="active<?php echo $cat['id']?>"  name="category[]" value="<?php echo $cat['category_name']?>" type="checkbox" class="check">
                                <label for="active<?php echo $cat['id']?>" class="check text-white f-ubuntu"><?php echo $cat['category_name']?></label>
                            </div>

                            <?php endforeach ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-sm-offset-3">
                        <button type="submit" class="btn btn- bg-black text-white no-border-radius btn-lg" style="width: 100%">SUBMIT</button>
                    </div>

                    <div class="clearfix"></div>
                <?php echo form_close()?>
            </div>



        </div>
    </div>
</section>

<!-- mobile search modal begins here -->

<div id="mobileSearch" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px">

        <!-- Modal content-->
        <div class="modal-content no-border-radius">

            <div class="modal-body">
                <div class="searchZippr">
                    <h4>Type your search and hit enter</h4>
                    <div class="form-group no-margin-xs">
                        <input class="width-100 search-control" placeholder="Username, Competition, Photo title here" type="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url('plugins/jquery.tagsinput/src/jquery.tagsinput.js')?>"></script>
<script src='<?php echo base_url()?>/js/dropzone.js'></script>

<script>


    Dropzone.options.mydropzone = {
        paramName: "file", // The name that will be used to transfer the file
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        uploadMultiple: true,
        maxFilesize: 5,

        init: function() {
            this.on("addedfile", function(file) {

                document.getElementById('processUpload').removeAttribute('hidden')
            });
        }

    }

</script>

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

</body>
</html>


</body>