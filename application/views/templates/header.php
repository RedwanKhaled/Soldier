<html>
    
    <head>
        
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.1.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
        
        <title>Add Soldier</title>
    </head>
    <body>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-offset-1">
                <div class="btn btn-default glyphicon glyphicon-search"><a href="<?php echo base_url().'soldier/search_soldier'?>"> Search</a></div>
                <div class="btn btn-default glyphicon glyphicon-plus "><a href="<?php echo base_url().'soldier/add_soldier_info' ?>"> Add</a></div>
                <div class="btn btn-default glyphicon glyphicon-th-list "><a href="<?php echo base_url().'soldier/show_all_soldiers'?>"> Show All</a></div>
            </div>
        </div>
