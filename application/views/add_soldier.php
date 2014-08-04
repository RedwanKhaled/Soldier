<br>
<div class="panel panel-default col-md-8 col-lg-offset-2" style="">
    <div class="panel-heading" style="font-family: monospace;"><b>Add New Soldier</b></div>
    <br>
    <div class="row form-horizontal form-background top-bottom-padding" style="">
    <?php echo form_open('soldier/add_soldier_info',array('id' => 'form_add_soldier', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'));?>
    <div class ="col-md-5 col-md-offset-2">
    <div class ="row">
            <div class="col-md-4"></div>
            <?php if(isset($status) && $status== 1){ ?>
            <div class="col-md-8" style="color: green"><?php echo $message; ?></div>
            <?php }elseif(isset($status) && $status== 0){?>
            <div class="col-md-8" style="color: red"><?php echo $message; ?></div>
            <?php } ?>
    </div>
    
    <div class="form-group">
        <label for="first_name" class="col-md-6 control-label requiredField">
            First Name
        </label>
        <div class ="col-md-6">
            <?php echo form_input($first_name+array('class' => 'form-control'));?>
        </div>
    </div>
    <div class="form-group">
        <label for="last_name" class="col-md-6 control-label requiredField">
            Last Name
        </label>
        <div class ="col-md-6">
            <?php echo form_input($last_name+array('class' => 'form-control'));?>
        </div>
    </div>
    <div class="form-group">
        <label for="rank" class="col-md-6 control-label requiredField glyphicon glyphicon-star-empty">
            Rank
        </label>
        <div class ="col-md-6">
            <?php echo form_input($rank+array('class' => 'form-control'));?>
        </div>
    </div>
    
    <div class="form-group">
        <label for="address" class="col-md-6 control-label requiredField glyphicon glyphicon-home">
            Address
        </label>
        <div class ="col-md-6">
            <?php echo form_input($address+array('class' => 'form-control'));?>
        </div>
    </div>
    
    <div class="form-group">
        <label for="phone" class="col-md-6 control-label requiredField glyphicon glyphicon-phone">
            Phone
        </label>
        <div class ="col-md-6">
            <?php echo form_input($phone+array('class' => 'form-control'));?>
        </div>
    </div>
    <div class="form-group">
            <label for="website" class="col-md-6 control-label requiredField">
            Set picture
            </label>
        <div class ="col-md-6">
            <div class="col-md-6">
                <div class="row fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Upload a photo</span>
                    <input id="fileupload" type="file" name="userfile">
                </div>
                <div id="progress" class="row progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>
            </div>

            <div class=" col-md-4">
                <div class="profile-picture-box" >
                    <div id="files" class="files">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
        <label for="submit" class="col-md-6 control-label requiredField">

        </label>
        <div class ="col-md-3 col-md-offset-3">
            <?php echo form_input($submit_add_soldier+array('class'=>'form-control btn-success')); ?>
        </div> 
    </div>
    </div>
    
    <?php echo form_close();?>
</div>

</div>


<script>

     $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        formData: $("form").serializeArray(),
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
// Enable image resizing, except for Android and Opera,
// which actually support image resizing, but fail to
// send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
        .test(window.navigator.userAgent),
        previewMaxWidth: 120,
        maxNumberOfFiles: 1,
        previewMaxHeight: 120,
        previewCrop: true
        }).on('fileuploadadd', function(e, data) {
                $("#files").empty();
                data.context = $('<div/>').appendTo('#files');
                $("div#upload").empty();
                $("div#upload").append('<br>').append(uploadButton.clone(true).data(data));
                $.each(data.files, function(index, file) {
                var node = $('<p/>');
                node.appendTo(data.context);
            });
        }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
        file = data.files[index],
        node = $(data.context.children()[index]);
        if (file.preview) {
        node.prepend('<br>').prepend(file.preview);
        }
        if (file.error) {
        $("div#header").append('<br>').append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
        data.context.find('button').text('Upload').prop('disabled', !!data.files.error);
        }
        }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css('width',progress + '%');
        }).on('fileuploaddone', function(e, data) {
            alert(data.result.message);
            window.location = '<?php echo base_url();?>soldier/add_soldier_info';
        }).on('fileuploadsubmit', function(e, data){
            data.formData = $('form').serializeArray();
        }).on('fileuploadfail', function(e, data) {
            alert(data.message);
            $.each(data.files, function(index, file) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index]).append('<br>').append(error);
            });
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

        });
</script>
