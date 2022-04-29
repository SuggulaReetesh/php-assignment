<?php
include_once('connect.php');
$conformationsection=false;
$confirmationid="";
$price="";
$status="";
$place="";
if(isset($_POST['submit'])){
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
    $address = $_POST['address'];
    $university = $_POST['university'];
    $address = $_POST['address'];
    $itemid = $_POST['itemid'];
    
	
    $sql = "insert into users values ('','$firstName', '$lastName', '$email','$university','$address','')";
    $result =mysqli_query($con, $sql);

    if($result){
        $lastuserid = mysqli_insert_id($con);
        $sql = "select price from items where id='$itemid'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $price = $row["price"];
            }
        } 
        $sql = "insert into purchases values ('','$lastuserid', '$itemid', '$price','true')";
        $result = mysqli_query($con, $sql);

        if($result){
            $lastpurchaseid = mysqli_insert_id($con);
            $sql = "insert into confirmations values ('','$lastpurchaseid','$price','packaging','iowa')";
            $result = mysqli_query($con, $sql);

            if($result){
                $lastconfirmationid = mysqli_insert_id($con);
                $sql = "select * from confirmations where confirmations_id='$lastconfirmationid'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $confirmationid = $row['confirmations_id'] ;
                    //echo $confirmationid; 
                    $price = $row["price_paid"];
                    //echo $price;
                    $status = $row["shipping_updates"];
                    //echo $status;
                    $place = $row["suggested_exchange_locations"];
                    //echo $place;

                }
            } 
            $conformationsection = true;
            }
           
            //echo "Insertion Successful in purchases";
        }
        //echo "Insertion Successful";
    }else{
        die(mysqli_error($con));
    }
}
?>




<!DOCTYPE html>
<html>

<head>
    <title>Ecommerce</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <meta charset="UTF-8">
</head>

<body>
    <div class="container">
        <div>
            <div class="panel panel-secondary">
                <div class="panel-heading text-center">
                    <h1 style="background-color: rgb(120, 231, 231);">Users</h1>
                    <p><span style="font-size: 10rem;">👩‍💼👨‍💼</span></p>
                </div>
                <div class="panel-body">
                    <form action="index.php" method="post">
                        <div class="col-lg-6 form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required />
                        </div>
                        <div class=" col-lg-6 form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required />
                        </div>
                        <div class=" col-lg-6 form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required />
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required />
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="university">University</label>
                            <input type="text" class="form-control" id="university" name="university" required />
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="itemid">ItemId</label>
                            <input type="text" class="form-control" id="itemid" name="itemid" required />
                        </div>
                        <button name="submit" class="btn btn-primary">submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <?php if ($conformationsection): ?>
            <div style="background-color:rgb(120, 231, 231);text-align:center;font-size: 3rem;">Congratulations on your
                order</div>
            <div style="background-color:rgb(0,0,0);text-align:center;font-size: 3rem;">Confirmation Number</div><br>
            <?= "<div>{$confirmationid }</div>" ?> <br>
            <div style="background-color:rgb(0,0,0);text-align:center;font-size: 3rem;">Price Paid</div>
            <?= "<div>{$price }</div>" ?><br>
            <div style="background-color:rgb(0,0,0);text-align:center;font-size: 3rem;">Shipping Updates</div>
            <?= "<div>{$status }</div>" ?><br>
            <div style="background-color:rgb(0,0,0);text-align:center;font-size: 3rem;">Suggested Exchange locations
            </div>
            <?= "<div>{$place}</div>" ?></br>
           
            <<button class="btn btn-primary" onClick="window.location.refresh();">Continue Shopping</button>
                <?php endif; ?>
        </div>
    </div>
</body>

</html>