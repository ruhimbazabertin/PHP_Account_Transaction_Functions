<?php
session_start();
if(!isset($_SESSION['balance'])){
  $_SESSION['balance'] = 15000;
}
$accountNo = "000-222-555";
$balance = $_SESSION['balance']; 
$message ="Something went wrong";

function checkBalance(){
       global $balance;
       return $balance;
}
function deposit(){
  global $balance; 
  $amount = $_POST['amount'];
    $balance = $balance + $amount;
    return $amount;
}
 function withdraw(){
  global $balance;
  $amount = $_POST['amount'];
  $balance = $balance - $amount;
  return $amount;
 }
 function convertInDollas(){
  global $balance;
  $dollas = $balance/1000;
  return $dollas; 
 }
 //CREATING ARRAY TO HOLD ACTION AND DATA
 $actionWithData = [];
 if(isset($_POST['account'])){
  $customerAccount = $_POST['account'];
  //CHECK IF ACCOUNT PROVIDED BY CUSTOMER IS VALID
  if($accountNo == $customerAccount && isset($_POST['balance'])){
  $actionWithData['action'] = "balance";
  $actionWithData['data'] = checkBalance();
}else if($accountNo == $customerAccount && isset($_POST['deposit'])){
    $actionWithData['action'] = "deposit";
    $actionWithData['data'] = deposit();
}else if($accountNo == $customerAccount && isset($_POST['withdraw'])){
  $actionWithData['action'] = "withdraw";
  $actionWithData['data'] = withdraw();

}else if($accountNo == $customerAccount && isset($_POST['convert'])){
    $actionWithData['action'] = "convert";
    $actionWithData['data'] = convertInDollas();
}else{
      echo $message;
}
}
$_SESSION['balance'] = $balance;
?>


<!DOCTYPE html>
<html>
<head>
  <title>Practical Work Correction</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-12" style="font-size: 30px; font-weight: bold">
      <center><strong>PRACTICAL WORK CORRECTION</strong></center>
      <hr style="border-color: red">
    </div>
  </div>
      <div class="row">
<!-- Calculation Section -->
        <div class="col-md-8 offset-2">
  <div class="form" style="margin-top: 50px; background-color: blue; color: white; border-color: 1px solid red; border-radius: 5px;height: 150px;">
    <form action="TestForTommorow.php" method="post">
      <div class="form-group">
      <div class="col-md-4"><label for="accountNo">Enter Account No:</label></div>
      <div class="col-md-4"><input type="text" name="account" required="true" /></div>
    </div>
          <div class="form-group">
      <div class="col-md-4"><label for="amount">Enter Dezired Amount: </label></div>
      <div class="col-md-4"><input type="number" name="amount"/></div>
    </div>
      <div class="form-group" style="margin-left: 10px;">
      <button type="submit" name="balance" class="btn btn-primary">CHECK BALANCE</button>
    <button type="submit" name="deposit" class="btn btn-success">DEPOSIT</button>
    <button type="submit" name="withdraw" class="btn btn-primary btn btn-danger">WITHDRAW</button>
    <button type="submit" name="convert" class="btn btn-warning btn btn-success">CONVERT IN US $</button>
  </div>
    </form>
  </div>
</div>
</div>
<br/><br/>

<hr style="border-color: red" />
<div class="col-md-8 offset-2" style="background-color: cyan; border-color: 1px solid red;">
<div class="jumbotron">
  <h2 class="text-center" style="top: -20px  color: white;">CUSTOMERS' ACCOUNT AND BALANCE</h2>
  <hr style="background-color: red" />
  <p>
      <?php
        if(isset($actionWithData['action'])){
          ?>
          <div>
            <?php if($actionWithData['action'] == "balance"){
              ?>
            <h2>
            AccountNo:<?php echo $accountNo ."<br/>" ?>
            Balance: <?php echo $actionWithData['data'];?>
          </h2>
        <?php } ?>
          </div>
          <div>
            <?php if($actionWithData['action'] =="deposit"){
              ?>
              <h2>
               AccountNo: <?php echo $accountNo; ?>
                  </h2>
                  <h2>
                    Deposited Amount: <?php echo $actionWithData['data']; ?>
                  </h2>
            <?php } ?>
          </div>
          <div>
          <?php if($actionWithData['action'] =="withdraw"){
            ?>
            <h2>
              AccountNo: <?php echo $accountNo ?>
            </h2>
            <h2>
              Withdrawn Amount: <?php echo $actionWithData['data']?>
            </h2>
         <?php } ?>
          </div>
          <div>
            <?php if($actionWithData["action"] =="convert"){
                    ?>
                    <h2>
                      AccountNo: <?php echo $accountNo ?>
                    </h2>
                    <h2>
                      Amount In Dollas:<?php echo $actionWithData['data'] ?>
                    </h2>
            <?php } ?>
          </div>
       <?php } ?>
  </p>
  </div>
</div>
</div>
</body>
</html>