  <?php

  //initialize

  /**
  *@author Jeffrey Takyi-Yeboah

  */
  //Create connection

  	//check command
  	if(!isset($_REQUEST['cmd'])){
  		echo "cmd is not provided";
  		exit();
  	}
  	/*get command*/
  	$cmd=$_REQUEST['cmd'];
  	switch($cmd){
  		case 1:
  			signUpUser();		//if cmd=1 the call delete
  			break;
  		case 2:
  			login();	//if cmd=2 the change status
  			break;
  		case 3:
  			editUser();
  			break;
  		case 4:
  			viewUser();
  			break;
  		default:
  			echo "wrong cmd";	//change to json message
  			break;
  	}

  function signUpUser(){

    if(empty($_REQUEST['email'])||empty($_REQUEST['username'])||empty($_REQUEST['fullname'])||empty($_REQUEST['password'])||empty($_REQUEST['phonenum'])){

      echo '{"result":0,"message":"Fill in all Details"}';
      return;
    }
        //again use ios code to validate fields and use http post request to use these fields
        $fullname =$_REQUEST['fullname'];
        $username =$_REQUEST['username'];
        $email =$_REQUEST['email'];
        $password= $_REQUEST['password'];
        $phonenum= $_REQUEST['phonenum'];
        $confirmPassword= $_REQUEST['password_confirmation'];

      include_once("users.php");
      //create an object of users
      $obj=new users();
      // call get user method

      $result=$obj->checkUsername($username);

      if($result==true){
        echo "true";
        if($row=$obj->fetch()){
          echo "fetching";
          echo '{"result":0,"message":"Username exists"}';
          return;
        }else{
          echo "not fetcing";
          $result=$obj->sign($date,$fullname,$username,$email,$password,$phonenum);
          echo $result;

        }
      }
      else{
        echo "false";
        $date=date("dd:mm:yy");
        $check = $obj->signUp($date,$fullname,$username,$email,$password,$phonenum);
        if($check==true){
          echo'{"result":1,"message":"Sign Up  Successful"}';
          return;
        }
        else{
          echo '{"result":0,"message":"Could not sign up user. Try again!"}';
          return;

        }
    }



}

function login(){
  if(empty($_REQUEST['login'])||empty($_REQUEST['password'])){

    echo '{"result":0,"message":"Fill in Details"}';
    return;
  }
//again use ios code to validate fields and use http post request to use these fields


$username =$_REQUEST['login'];
$password= $_REQUEST['password'];

include_once("users.php");
//create an object of users
$obj=new users();
// call get user method

$result=$obj->login($username,$password);

//print_r($result);
if($result==1){
$row = $obj->fetch();
if($row==true){
echo'{"result":1,"message":"Log In Successful"}';
return;
}
else{
echo '{"result":1,"message":"Wrong Credentials. Enter correct username and password"}';
return;
}
}
else{
echo '{"result":0,"message":"Could not log in user. Try again!"}';
return;

}
}







?>
