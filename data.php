<?php


$conn = new mysqli("localhost", "circkpsq_reselling", "Allahis1&only.", "circkpsq_reselling");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST)){
    

$s_info = array(
"name" =>$_POST['customer_name'], 
"address" => $_POST['shipping_address'], 
"phone" => $_POST['phone']
);

$data1 = json_encode($s_info,JSON_UNESCAPED_UNICODE);
$data = str_replace(["'", "/[^A-Za-z0-9\-]/"], ' ', $data1);
$shipping_address = $data;

$grand_total = $_POST[total_price]+$_POST[delivery_charge];

$sql = "INSERT INTO orders(user_id,shipping_address,customer_name,customer_phone, 
selling_total,delivery_charge,customer_charge,date) VALUES ('116','$shipping_address','$_POST[customer_name]','$_POST[phone]',
'$grand_total','$_POST[delivery_charge]','$_POST[delivery_charge]','".time()."')";
$query = $conn->query($sql) or die($conn->error);



$q="SELECT id FROM orders WHERE customer_phone='$_POST[phone]' ORDER BY id DESC LIMIT 1";
$run = $conn->query($q) or die($conn->error);
$row3= $run->fetch_assoc();
foreach($row3 as $value){
    $order_id= $value;
}


$count = count($_POST);
$array1 = array_slice($_POST, 0, 5);
$array2 = array_slice($_POST, 5, $count);

$count2 = count($array2);

$s = "INSERT INTO order_details(order_id,reseller_id,product_id,supplier_id,variation,purchase_price,price,selling_price,circle_price,seller_price,quantity) VALUES";

for($i=0; $i<count($array2); $i++)
{
        $selling_price =$array2[$i]['unit_price']*$array2[$i]['qty'];

        $price = "SELECT id,purchase_price,unit_price,supplier_id FROM products WHERE tags='".$array2[$i]['sku']."'";
        $run1 = $conn->query($price) or die($conn->error);
        $row5= $run1->fetch_assoc();
        

        $price= $row5['unit_price']*$array2[$i]['qty'];

        $s.="('".$order_id."','116','".$row5['id']."','".$row5['supplier_id']."','".$array2[$i]['prod_size']."','".$row5['purchase_price']."',
        '".$price."','".$selling_price."','".$price."','".$selling_price."','".$array2[$i]['qty']."'),";

}
$s = rtrim($s,",");
$query = $conn->query($s) or die($conn->error);

// end of isset....
}
?>
