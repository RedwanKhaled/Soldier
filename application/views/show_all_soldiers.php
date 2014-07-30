<style>
    .table td {
        text-align: center;
    }
    .table th {
        text-align: center;
        font-size: larger;
    }
</style>
<br>
<div class="panel panel-default col-md-10 col-lg-offset-1">
    <div class="panel-heading">Showing All Soldier</div>
    <div class="panel-body col-md-12">
        <div class="row col-md-12">
            <div class="row form-group">
                <div class ="col-sm-12"></div>
            </div>
            <div class="row">
                <div class="table-responsive table-left-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_recipes_category_list">
                            <?php $i=1;foreach($all_soldiers_info as $soldier):?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $soldier['rank']?></td>
                                <td><?php echo $soldier['first_name'].' '.$soldier['last_name'];?></td>
                                <td><a href="<?php echo base_url().'soldier/show_soldier_info/'.$soldier['id']?>"><button class="btn btn-default">View</button></a></a></td>
                                <td><a href="<?php echo base_url().'soldier/edit_soldier_info/'.$soldier['id']?>"><button class="btn btn-info">Edit</button></a></td>
                            </tr>

                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>        
    </div>
</div>