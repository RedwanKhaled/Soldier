<br>
<div class="panel panel-default col-sm-9 col-lg-offset-1">
    <div class="panel-heading">Details</div>
    <div class="panel-body">
        <div class="row form-horizontal">
            <div class="row form-group">
                <div class ="col-sm-12"></div>
            </div>
            <div class="row col-sm-8 col-lg-offset-4">
                <div class="form-group">
                	<div class="col-sm-2"><image src="<?php echo base_url();?>/assets/images/<?php echo $soldier['picture'];?>" height='150' width='150'></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Rank </div>: <?php echo $soldier['rank'];?>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">First Name</div> : <?php echo $soldier['first_name'];?>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Last Name</div> : <?php echo $soldier['last_name'];?>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Phone</div> : <?php echo $soldier['phone'];?>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Address</div> : <?php echo $soldier['address'];?>
                </div>
            </div>
        </div>
        <div>
            <div class="panel panel-default">
            <div class="panel-heading">
                Comments
            </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody></tbody>
                            <?php foreach ($comments_list as $comments):?>
                                <tr>
                                <div style="width: 100%;">
                                    <br>
                                    <?php echo html_entity_decode($comments['description']);?>
                                    <br>
                                </div>
                                
                                <div style="width: 100%">
                                    <?php echo unix_to_human($comments['created_on']);?>
                                </div>
                                </tr>
                            
                            <?php endforeach;?>
                            <div>
                                <tr>
                                    <textarea id="text_remark" style="width: 100%">

                                    </textarea>
                                </tr>
                            </div>
                        <input type="submit" value="Submit" class="form-control btn-success" style="width: 100px" id="submit_remark">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#submit_remark').on('click',function(){
            var txt = $('#text_remark').val();
            var text = txt.replace("<br>",",");
            var id = <?php echo $soldier['id'];?>;
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: '<?php echo base_url()?>'+'soldier/add_soldier_remark',
                data: {
                  'description' : text,
                  'soldier_id'  : id
                },
                success: function(data){
                    alert(data.message);
                    window.location = '<?php echo base_url()?>'+'soldier/show_soldier_info/'+id;
                    location.replace();
                }
            });
        });
    });
</script>
