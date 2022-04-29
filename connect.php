<?php
$con = mysqli_connect('localhost','root','','e_commerce');
if(!$con){
    die(mysqli_error("Error"+$con));
}

items table
$sql = "CREATE TABLE items (
    id INT  AUTO_INCREMENT PRIMARY KEY,
    men_women VARCHAR(30) NOT NULL,
    tyepofcloth VARCHAR(30) NOT NULL,
    size VARCHAR(50),
    price INT NOT NULL,
    conditionofproduct VARCHAR(255) NOT NULL 
    )";
    
    if ($con->query($sql) === TRUE) {
      echo "Table MyGuests created successfully";
    } else {
      echo "Error creating table: " . $con->error;
    }

//users table    
$sql =  "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    university VARCHAR(50),
    addressses VARCHAR(50),
    pssword VARCHAR(50)
    )";
    
    if ($con->query($sql) === TRUE) {
      echo "Table users created successfully";
    } else {
      echo "Error creating table: " . $con->error;
    }

purchases table    
$sql =  "CREATE TABLE purchases (
        purchase_order_id INT  AUTO_INCREMENT PRIMARY KEY,
        userid INT ,
        itemid INT ,
        price VARCHAR(50),
        paidinfull VARCHAR(50),
        FOREIGN KEY(userid) REFERENCES users(id),
        FOREIGN KEY(itemid) REFERENCES items(id)
        )";
        
        if ($con->query($sql) === TRUE) {
          echo "Table purchases created successfully";
        } else {
          echo "Error creating table: " . $con->error;
        }

//confirmations table
$sql =  "CREATE TABLE confirmations (
            confirmations_id INT  AUTO_INCREMENT PRIMARY KEY,
            purchase_order_id INT,
            price_paid VARCHAR(30) ,
            shipping_updates VARCHAR(50),
            suggested_exchange_locations VARCHAR(50),
            FOREIGN KEY(purchase_order_id) REFERENCES purchases(purchase_order_id)
            )";
            
            if ($con->query($sql) === TRUE) {
              echo "Table confirmations created successfully";
            } else {
              echo "Error creating table: " . $con->error;
            }
?>