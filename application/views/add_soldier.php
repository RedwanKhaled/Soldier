<br>
<div class="panel panel-default col-md-8 col-lg-offset-2" style="">
    <div class="panel-heading" style="font-family: monospace;"><b>Add New Soldier</b></div>
    <br>
    <div class="row form-horizontal form-background top-bottom-padding" style="">
    <?php echo form_open('soldier/add_soldier_info',array('id' => 'form_add_soldier', 'class' => 'form-horizontal'));?>
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