
    <!-- Generic page styles -->
    <link rel="stylesheet" href="<?php echo base_url()?>css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="<?php echo base_url()?>css/jquery.fileupload.css">

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

        .xxjj{
            margin-top: 50px;
            background:#f2f2f2;
            padding:20px;

        }

        .videoClear{

            margin 0;
            font-family: 'ubuntu', Sans-serif;

        }

        .videoClear video{

            width: 100%;
            margin: 20px;
        }


    </style>

<a href="" onclick="clearjQueryCache()">Clear Cache</a>
<div class="container m-t-40">


    <div style="background: #f2f2f2;padding: 10px;margin-top: 100px">




        <?php echo form_open_multipart()?>

        <div class="form-group">
            <input type="file" name="file" class="form-control">
        </div>

        <div class="form-group">
            <input type="button" class="btn bg-black text-white" value="Upload">
        </div>


        <?php echo form_close()?>


        <h5 class="m-b-0" style=""> Click on the Add Button to add your video</h5>
        <br>
        <!-- The fileinput-button span is used to style the file input field as button -->

        <!-- The global progress bar -->
        <div id="progress" class="progress" >
            <div class="progress-bar progress-bar-striped active"></div>
        </div>


        <span class="btn bg-red text-white no-border-radius fileinput-button" >
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add videos...</span>
            <!-- The file input field used as target for the file upload widget -->
            <input id="fileupload" type="file" name="file" multiple>
        </span>

        <!-- The container for the uploaded files -->
        <div id="files" class="files">



        </div>


        <div class="clearfix"></div>
    </div>
    <br>
    <div class="upload-info no-padding-xs xxjj" id="processUpload" hidden>
        <?php echo form_open()?>
        <div class="uploaded-picture">

            <h5 class="m-t-0 m-b-40" style="border-bottom: 1px solid #d2d2d2">Give information about the uploaded <span class="text-red">Video</span> </h5>

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




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url()?>js/upload_js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url()?>js/upload_js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url()?>js/upload_js/jquery.fileupload-validate.js"></script>


<script type="text/javascript">



    function clearjQueryCache(){
        for (var x in jQuery.cache){
            delete jQuery.cache[x];
        }
    }

</script>

    <script>


        Dropzone.options.mydropzone = {

            paramName: "file", // The name that will be used to transfer the file
            acceptedFiles: ".mp4",
            uploadMultiple: true,
            maxFilesize: 200,
            MaxFiles: 1,

            init: function() {
                this.on("addedfile", function(file) {

                    document.getElementById('processUpload').removeAttribute('hidden')
                });
            }

        }


    </script>


<script>
    /*jslint unparam: true, regexp: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname ===  'blueimp.github.io' ?
            '//jquery-file-upload.appspot.com/' :'<?php echo  base_url()?>upload/upload_video',
            uploadButton = $('<button/>')
                .addClass('btn bg-black text-white')
                .prop('disabled', true)
                .text('Processing...')
                .on('click', function () {
                    var $this = $(this),
                        data = $this.data();
                    $this
                        .off('click')
                        .text('Abort')
                        .on('click', function () {
                            $this.remove();
                            data.abort();
                        });
                    data.submit().always(function () {
                        $this.remove();
                    });
                });
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            autoUpload: false,
            acceptFileTypes: /(\.|\/)(mp4|webm|3gp)$/i,
            //maxFileSize: 999000,
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            previewMaxWidth: 100,
            previewMaxHeight: 100,
            previewCrop: true
        }).on('fileuploadadd', function (e, data) {
            data.context = $('<div class="col-sm-6 videoClear"/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p class="m-0 p-0"/>')
                    .append($('<span/>').text(file.name));
                if (!index) {
                    node
                        .append('<br>')
                        .append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });


        }).on('fileuploadprocessalways', function (e, data) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node
                    .prepend('<br>')
                    .prepend(file.preview);
            }
            if (file.error) {
                node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                data.context.find('button')
                    .text('Upload')
                    .prop('disabled', !!data.files.error);
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }).on('fileuploaddone', function (e, data) {
            $.each(data.result.files, function (index, file) {
                if (file.url) {
                    var link = $('<a>')
                        .attr('target', '_blank')
                        .prop('href', file.url);
                    $(data.context.children()[index])
                        .wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                }
            });

            document.getElementById('processUpload').removeAttribute('hidden')


        }).on('fileuploadfail', function (e, data) {
            $.each(data.files, function (index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>
