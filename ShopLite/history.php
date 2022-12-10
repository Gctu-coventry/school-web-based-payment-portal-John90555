<?php
session_start();
include('dbcontroller.php');
$db_handle = new DBController();
$sess_id = $_SESSION['sess_id'];
$check = $db_handle->exist("SELECT * FROM orders WHERE sess_id='$sess_id' ");
if($check == "true"){
   // while($history){
?>

<html>
    <head>
        <title>
            History
        </title>
        		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="mt-3"><i><a href="logout.php" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color:white;" class=" p-4">Logout</a></i><i><a href="#" class=" p-4" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color:white;">History</a><a href="products.php" class=" p-4" style="color: black; text-decoration:none; font-size:medium; background-color: black; padding:10px; color:white;">Back To store</a></i></div>
    <br>
        <div class="wrapper rounded"> 
            <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start"> 
                <a class="navbar-brand" href="#">Transactions <p class="text-muted pl-1">View transactions</p> </a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button> 
                 <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav ml-lg-auto"> <li class="nav-item"> <a class="nav-link" href="#"><span class="fa fa-bell-o font-weight-bold"></span> 
                      <span class="notify">Notifications</span> </a> </li> <li class="nav-item "> </li> </ul> </div> </nav> 
                           
                                           <div class="table-responsive mt-3 ">
                                           <table class="table table-dark table-borderless "> <thead> <tr> <th scope="col">Order_id</th> <th scope="col">Product Name</th> <th scope="col">Quantity</th> <th scope="col">Q_Price</th><th scope="col">Status</th> <th scope="col" class="text-right">Grand Total</th> <th scope="col">Action</th></tr> </thead> 
				<tbody>  
                                          <?php $history = $db_handle->history("SELECT * FROM orders WHERE sess_id='$sess_id' ");?>
                                          </tbody> 
			 </table>
                                                </div> 
</div>
<?php




//}
}else{?>
    <tr>NO Purchase History</tr>
        <?php
}
?>
    </body>
</html>
<script>
    function refund(id){
        
        alert('Refund for order_id '+ id +' has been rquested');
    }
    function ref(id){
        var de = id;
        FormData = {id:de};
        $.ajax(
            {
                   type: "POST",
                   url: "includes/r_out.php",
                   data: FormData,
                   success: function(response)
                   {
                    console.log(response);

                   }
                });
    }
</script>