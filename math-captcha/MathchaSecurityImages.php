<?php
session_start();
//this class is for generate operand or number
class Operand
	{
		var $number;
		var $first;
		var $second;
		function __construct($first,$second)
		{
			$this->number = "0";
			$this->first = $first;
			$this->second = $second;
		}
		
		function generate_number()
		{
			$first=$this->first;
			$second=$this->second;
			$a=rand ($first,$second);
			
			$this->number= $a;					
		}
				
	}
// this class is for generate operator, like +, -, or X
	class Operator
	{
		var $rangeOperator;
		var $Operator;
		
		function __construct($rangeOperator)
		{
			$this->rangeOperator = $rangeOperator;
		}
			
		function generate_operator()
		{
			$operator = $this->rangeOperator;
			$op=substr($operator, mt_rand(0, strlen($operator)-1), 1);
			
			$this->Operator=$op;				
		}
		
	}

//there is three level of difficulty: easy, moderate, hard
//class easy have 2 operaand and 1 operator, the range of operand is 1-10
class easy
	{
		var $expression="";			//@param $expression : MathCha math question
		var $security_code="";		//@param $security_code : answer of MathCha
		var $a="";					//@param $a : first number
		var $b="";					//@param $b : operator
		var $c="";					//@param $c : second number
		function __construct()
		{
			$this->expression = $expression;
			$this->security_code = $security_code;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
		}
		//this function generate number, generate operator, and calculate the answer
		function result()
		{	
			//generate first number
			$number1 = new Operand(1,10);
			$number1->generate_number();

			//generate second number	
			$number2 = new Operand(1,10);
			$number2->generate_number();
	
			//generate operator
			$operator = new Operator('+-');
			$operator->generate_operator();
			
			//calculate result
			$a= $number1->number;
			$b= $operator->Operator;
			$c= $number2->number;
			if ($b=='+')
			{
				$d= $a + $c;
			}
			if ($b=='-')
			{
				$d= $a - $c;
			}
			
			$this->expression =$a.$b.$c;
			$this->security_code=$d;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
		}
		
	}
	
	//class moderate have 2 operand and 1 operator, the range of operand is 10-50
	class moderate
	{
		var $expression="";
		var $security_code="";
		var $a="";
		var $b="";
		var $c="";
		function __construct()
		{
			$this->expression = $expression;
			$this->security_code = $security_code;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
		}
		//this function generate number, generate operator, and calculate the answer
		function result()
		{
			//generate first number
			$number1 = new Operand(10,50);
			$number1->generate_number();

			//generate second number
			$number2 = new Operand(10,50);
			$number2->generate_number();
			
			//generate operator
			$operator = new Operator('+-*');
			$operator->generate_operator();
			
			//calculate result
			$a= $number1->number;
			$b= $operator->Operator;
			$c= $number2->number;
			if ($b=='+')
			{
				$d= $a + $c;
			}
			if ($b=='-')
			{
				$d= $a - $c;
			}
			if ($b=='*')
			{
				$d= $a * $c;
			}
	
			$this->expression =$a.$b.$c;
			$this->security_code=$d;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
		}
	}
	
	//class hard have 3 operand and 2 operator, the range of operand is 1-10
	class hard
	{
		var $expression="";
		var $security_code="";
		var $a="";
		var $b="";
		var $c="";		
		var $d="";
		var $e="";

		function __construct()
		{
			$this->expression = $expression;
			$this->security_code = $security_code;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
			$this->d = $d;
			$this->e = $e;
		}
		//this function generate number, generate operator, and calculate the answer
		function result()
		{
			//generate first number
			$number1 = new Operand(1,10);
			$number1->generate_number();
			
			//generate second number
			$number2 = new Operand(1,10);
			$number2->generate_number();
			
			//generate third number
			$number3 = new Operand(1,10);
			$number3->generate_number();
			
			//generate first operator
			$operator1 = new Operator('+-*');
			$operator1->generate_operator();
			
			//generate second operator
			$operator2= new Operator('+-*');
			$operator2->generate_operator();
			
			//calculate result
			$a= $number1->number;
			$b= $operator1->Operator;
			$c= $number2->number;
			$d= $operator2->Operator;
			$e= $number3->number;
			if ($b=='+')
			{
				$temp= $a + $c;
			}
			if ($b=='-')
			{
				$temp= $a - $c;
			}
			if ($b=='*')
			{
				$temp= $a * $c;
			}

			if ($d=='+')
			{
				$result= $temp + $e;
			}
			if ($d=='-')
			{
				$result= $temp - $e;
			}
			if ($d=='*')
			{
				$result= $temp * $e;
			}
			
			$this->expression =$a.$b.$c.$d.$e;
			$this->security_code=$result;
			$this->a = $a;
			$this->b = $b;
			$this->c = $c;
			$this->d = $d;
			$this->e = $e;
		}
	}

//this class use to create images of Math expression
class MathChaSecurityImages {	
	//function to create images
	function MathChaSecurityImages($difficulty,$theme) {
		//size of images
		$width= 70;
		$height= 20;
		//font size
		$min_font_size = 14;
		$max_font_size = 16;
		//angel for rotation
		$angle = 0;
		
		//difficult level of Math expression
		if($difficulty=='1')
		{
			$result = new easy();
			$result->result();
			$a=$result->a;
			$b=$result->b;
			$c=$result->c;
			$answer=$result->security_code;
		}
		if($difficulty=='2')
		{
			$result = new moderate();
			$result->result();
			$a=$result->a;
			$b=$result->b;
			$c=$result->c;
			$answer=$result->security_code;
		}
		if($difficulty=='3')
		{
			$result = new hard();
			$result->result();
			$a=$result->a;
			$b=$result->b;
			$c=$result->c;
			$d=$result->d;
			$e=$result->e;
			$answer=$result->security_code;
		}
		
		//theme for captcha images
		//to get the theme please send the email to one of the address below:
		// hesti06@gmail.com
		// cyntiaan@gmail.com
		// pho3_lophe@yahoo.com
		// mikha3qv9@gmail.com
		// syamsularies@ymail.com
		// we'll send you the theme
		// or follow the link :   http://www.mediafire.com/file/k0vc6ziz4hkk9oa/math_chaptcha.rar
		if($theme=='t0') {
            $bg = 'theme/bg0.png';
			$color='';
            }
		else if($theme=='t1'){
            $bg = 'theme/bg1.png';
			}
		else if($theme=='t2') {
            $bg = 'theme/bg2.png';
			$color='';
            }
        else if($theme=='t3') {
            $bg = 'theme/bg3.png';
            }
        else if($theme=='t4') {
            $bg = 'theme/bg4.png';
            }
		else if($theme=='t5') {
            $bg= 'theme/bg5.png';
            }
        else if($theme=='t6') {
            $bg= 'theme/bg6.png';
            }
        else if($theme=='t7') {
            $bg= 'theme/bg7.png';
            }
        else if($theme=='t8') {
            $bg= 'theme/bg8.png';
            }
        else if($theme=='t9') {
            $bg = 'theme/bg9.png';
            }
        else if($theme=='t10') {
            $bg = 'theme/bg10.png';
            }
			
      	//code for create images	
		$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
        $name = $bg;
        $image = imagecreatefrompng($name);
		$font_path = './comic.ttf';
		if($difficulty=='1')
		{	
			$item_space = 20;
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 10,item_space-5 ),$height,$black,$font_path,$a);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( $item_space, 2*$item_space-5 ),$height,$black,$font_path,$b);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 2*$item_space, 3*$item_space-5 ),$height,$black,$font_path,$c);		
		
		}
		if($difficulty=='2')
		{	
			$item_space = 50;
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 10, $item_space-30 ),$height,$black,$font_path,$a);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( $item_space, 2*$item_space-30 ),$height,$black,$font_path,$b);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 2*$item_space, 3*$item_space-20 ),$height,$black,$font_path,$c);
		
		
		}
		if($difficulty=='3')
		{	
			$item_space = 25;
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 10, $item_space-5 ),$height,$black,$font_path,$a);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( $item_space, 2*$item_space-5 ),$height,$black,$font_path,$b);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 2*$item_space, 3*$item_space-5 ),$height,$black,$font_path,$c);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 3*$item_space, 4*$item_space-5 ),$height,$black,$font_path,$d);
			imagettftext($image,rand($min_font_size,$max_font_size),rand( -$angle , $angle ),rand( 4*$item_space, 5*$item_space-5 ),$height,$black,$font_path,$e);
		
		}
			header('Content-Type: image/jpeg');
			imagejpeg($image);
			imagedestroy($image);
		//save the answer of math expression to 'security_code' session
		$_SESSION['security_code'] = $answer;
	}

}
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : '3';
$theme = isset($_GET['theme']) ? $_GET['theme'] : 't5';

//create new class
$captcha = new MathChaSecurityImages($difficulty,$theme);

?>

<?PHP
//README

/*
MathCha License
MathCha  - the Mathematical Captcha
GNU General Public License 2011 MathchaTeamPBK2011

To Obtain more information for this component please send an email to certain address below :
1. hesti06@gmail.com
2. cyntiaan@gmail.com
3. pho3_lophe@yahoo.com
4. mikha3qv9@gmail.com
5. syamsularies@ymail.com

Please Keep this license if you uses or make modifications of this component.

By fullfiing this requirement, we are able to give pemittion to use device for free.
we are able to give advices for any problem in the proccess to use the device.

===============================================================================================

This component is made to give another choice of Captcha for all of you.
This Captcha utilizable for your website.

How to use?

Don't forget to call the session!

<?PHP
  session_start();
  //The session use for check the MathCha answer
  if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {  	//if the answer is true
		echo 'Thank you! ';
		unset($_SESSION['security_code']);
   } else {			//if the answer is false
		echo 'Ups, you have provided an invalid security code! Please '
   }
?> 
  
//Then,call the MatCha like call the picture along with level change and theme change that we are served.

<img src="MathchaSecurityImages.php?difficulty=3&theme=t0" />

You are able to choose three posibilities the term of Level by change the available selection 1, 2, or 3
You able to choose 11 available themes into : t0, t1, t2, t3, t4, t5, t6, t7, t8, t9, or t10

You can do another way to use this component.

**Hesti-Cyntia-Debora-Mikha-Syamsul (UKDW Yogyakarta)**
*/
?>