<?php 
include('dbcontroller.php');
$db_handle = new DBController();
$history = $db_handle->adminhistory("SELECT * FROM orders WHERE order_status ='Requested_Refund' ");?>

<script>
        function refund(id){
        
        alert('Refund for order_id '+ id +' has been completed');
    }
    function ref(id){
        var de = id;
        //var amount = name;
        //, amount:amount
        FormData = {id:de};
        $.ajax(
            {
                   type: "POST",
                   url: "includes/adminrefund.php",
                   data: FormData,
                   success: function(response)
                   {
                    console.log(response);

                   }
                });
    }
    </script>
