<br>
<div class="panel panel-default col-md-8 col-lg-offset-2">
    <div class="panel-heading">Search Soldier</div>
    <br>
<div class="row form-horizontal form-background top-bottom-padding">
    <div class ="row">
            <div class="col-md-4"></div>
            <div class="col-md-8"><?php echo $message; ?></div>
    </div>
        <div class="form-group ">
            <div class="col-md-5">
            <select id="hello" class="col-lg-offset-5" >
                <option value="0">
                    Select
                </option>
                <?php for($i=0;$i<count($soldier);$i++):?>
                    <option value="<?php echo $soldier[$i]['id']?>">
                        <?php echo $soldier[$i]['rank'].' '.$soldier[$i]['first_name'].' '.$soldier[$i]['last_name']?>
                    </option>
                <?php endfor;?>
            </select>
            </div>
            <div class="col-md-3">
            <input type="submit" value="Show" class="form-control btn-primary col-md-4 col-lg-offset-2" id="show_submit">
            </div>
            
        </div>
    <br>

    </div>
</div>

</div>

<script type="text/javascript">
    
    
    $(function(){
       $('#show_submit').on('click',function(){
            var id = $('#hello').val();
            if(id == 0){ alert('Please Select a name');return;}
            
            window.location = '<?php echo base_url()?>soldier/show_soldier_info/'+id;
            location.replace();
       });
    });
    
</script>