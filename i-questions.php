OPPS
JS
PHP
MySQL
MySQL Scalling
LOGICAL
SECURITY - OWASP 
SERVER
REGEX
OPTIMIZATION
	CODE LEVEL
	SERVER SERVER LEVEL 
	SCALLING
	DB LEVEL
	Caching
Monitoring
Design Patterns	
REST API
OTHER Technologies
	RabbitMQ
	MongoDb
	Caching
Algorithm	


How to prevent user to use api without authentication ? 

OpenAPI
SOLID Principles
--------------------------------------------------------------- 
OOPS
---------------------------------------------------------------
Class
Object

https://www.fullstacktutorials.com/interviews/oops-interview-questions-and-answers-for-experienced-in-php-5.html

Polymorphism - the ability to have many forms
	Method Overload
		Same Function name with diffrent parameter. Not supported in PHP. 
		We can use __call magic method and based on parameter will call sepecific method in class 
	Method Overriding
		Parent class and Child class has same name function 

Encapsulation
	Wrapping up member variables and methods together into a single unit (i.e. Class) is called Encapsulation.
	Encapsulation is used to hide the values or state of a structured data object inside a class, preventing unauthorized parties' direct access to them.
	Visibility is the mechanism for encapsulation.

Abstraction - https://codeinphp.github.io/post/abstract-class-vs-interface/
	An abstract class can provide some functionality and leave the rest for derived class


inheritance
	single level
	multi level
	multiple inheritance
	

Interface
	An interface cannot contain any functionality. It only contains definitions of the methods.
	the derived class MUST provide code for all the methods defined in the interface.

namespace
constructor and distructor	
Public,Private,Protected
const
	final
static
Traits	
late static bindings
	Object cloning
	Call by reference vs call by object vs call by value
	Design pattern
		Singleton
		Factory pattern
		<?php
			interface IUser
			{
			  function getName();
			}
			 
			class User implements IUser
			{
			  public function __construct( $id ) { }
			 
			  public function getName()
			  {
			    return "Jack";
			  }
			}
			 
			class UserFactory
			{
			  public static function Create( $id )
			  {
			    return new User( $id );
			  }
			}
			 
			$uo = UserFactory::Create( 1 );
			echo( $uo->getName()."\n" );
			?>
		
		Strategy pattern
	MVC
	Magic methods
		__call
		__get
		__set
		__sleep
		__isset

---------------------------------------------------------------
JS 
---------------------------------------------------------------

- Let vs Var
	https://www.geeksforgeeks.org/difference-between-var-and-let-in-javascript/

- js asynchronous and synchronous

- Jquery funcitons
	.length
	.remove
	.val 
	.html
	.text
	.css
	JSON.stringify
	JSON.parse

- Events
	onclick
	onchange
	onblur
	key up
	key down
	on mouse
		over
		leave
		enter

- Object vs JSON

- Js hoisting
	Hoisting is JavaScript's default behavior of moving all declarations to the top of the current scope (to the top of the current script or the current function).

- Promises 
	https://www.geeksforgeeks.org/javascript-promises/
	Promises are used to handle asynchronous operations in JavaScript.
	Benefits of Promises
		Improves Code Readability
		Better handling of asynchronous operations
		Better flow of control definition in asynchronous logic
		Better Error Handling

	var promise = new Promise(function(resolve, reject) { 
		const x = "geeksforgeeks"; 
		const y = "geeksforgeeks"
		if(x === y) { 
			resolve(); 
		} else { 
			reject(); 
		} 
	}); 

	promise. 
	then(function () { 
		console.log('Success, You are a GEEK'); 
	}). 
	catch(function () { 
		console.log('Some error has occured'); 
	}); 


- callback
	If we want to execute a function right after the return of some other function, then callbacks can be used.
	callback function can be passed as an argument to any other function while calling


	
	function add(a, b , callback){ 
		document.write(`The sum of ${a} and ${b} is ${a+b}.` +"<br>"); 
		callback(" ---> called from callback"); 
	} 
		
	function disp(msg){ 
		document.write('This must be printed after addition'+msg); 
	} 
		
	add(5,6,disp);


- closures - In other words, closure is created when a child function keep the environment of the parent scope even after the parent function has already executed

	function foo(outer_arg) { 
  
	    function inner(inner_arg) { 
	        return outer_arg + inner_arg; 
	    } 
	    return inner; 
	} 
	var get_func_inner = foo(5); 
	  
	console.log(get_func_inner(4)); 
	console.log(get_func_inner(3)); 

this keyword in js
	https://www.geeksforgeeks.org/this-in-javascript/
es6
file strem and file read
data types in javascript

inheritance
encapsulation

setinverval & stetimeout
- Write down syntax for ajax call ? 
	$.ajax({
		url : 
		type : POST/GET,
		data : {key:value},
		dataType : json/xml/html,
		async : false,
		success: function(data){

		},
		error : function(){

		}
	})



---------------------------------------------------------------
PHP 
---------------------------------------------------------------
- include,include_once,require,require_once

- namespace
	It allows redeclaring the same functions/classes/interfaces/constant functions in the separate namespace without getting the fatal error.

	Namespace affects following types of code: classes (including abstracts and traits), interfaces, functions, and constants.
	
	A namespace is used to avoid conflicting definitions and introduce more flexibility and organization in the code base. Just like directories, namespace can contain a hierarchy know as subnamespaces. PHP uses the backslash as its namespace separator.

- php7 new features 

	- define constants as array

	- spacesip operator  <=>
		Return 0 if values on either side are equal
		Return 1 if value on the left is greater
		Return -1 if the value on the right is greater

		//Comparing Integers

	    echo 1 <=> 1; //ouputs 0
	    echo 3 <=> 4; //outputs -1
	    echo 4 <=> 3; //outputs 1

	    //String Comparison

	    echo "x" <=> "x"; // 0
	    echo "x" <=> "y"; //-1
	    echo "y" <=> "x"; //1

	??	Null coalescing

	declare(strict_types=1); for string type data type
	Return Type Declarations

- session vs cookies
	setcookie(name,value,expire,path,domain,secure,httponly);
	https://www.guru99.com/cookies-and-sessions.html

- What Is A Persistent Cookie?
	Answer :
	A persistent cookie is a cookie which is stored in a cookie file permanently on the browser's computer. By default, cookies are created as temporary cookies which stored only in the browser's memory. When the browser is closed, temporary cookies will be erased. You should decide when to use temporary cookies and when to use persistent cookies based on their differences:

	· Temporary cookies can not be used for tracking long-term information.
	· Persistent cookies can be used for tracking long-term information.
	· Temporary cookies are safer because no programs other than the browser can access them.
	· Persistent cookies are less secure because users can open cookie files see the cookie values


- How to find string length in php with out using strlen()?
	$s = 'string';
	$i=0;
	while (isset($s[$i])) {
	  $i++;
	}
	print $i;	
	
- Is PHP Multitreading? If Yes, How?

- How to retrieve Last element of an array - end($array)

- find a string character count without using string functions ?

	$str =  'Hello WOrld!';

	$i=0;
	$arr = [];
	while(isset($str[$i])){
	   $ch = strtolower($str[$i]);
	  if(isset($arr[$ch])){
	       $arr[$ch] +=1;
	    }else{
	       $arr[$ch] = 1;
	    }
	   
	  $i++;
	}
	echo "<pre>";
	print_r($arr);

- file handling

- PHP Methods of increasing execution time 
	default : 30 sec 
	ini_set('max_execution_time', 300);
	max_excecution_time
	set_time_limit - safe_mode is off

- PHP Swapping two numbers 
    - by add and subtrack 
		$a = 10;
		$b = 5;
		$b = $a + $b;
		$a = $b -$a;
		$b = $b-$a;
		echo "a=".$a;
		echo "<br/>b=".$b;
    
    - by multiply and divide
		$a = 10;
		$b = 5;
		$a = $a*$b;
		$b = $a/$b;
		$a = $a/$b;

		echo "a=".$a;
		echo "<br/>b=".$b;	


- factorial of n 
	function fact($n){
	  if($n==1 || empty($n)){
	      return $n;
	    }
	  return $n * fact($n-1);
	}

	echo fact(4);

- Different types of errors in php. How to enable and disable each one?
- Late static binding
-  How to limit object initialization to once?
- Private constructor vs public constructor
- how we get IP address of client, previous reference page etc ?
	By using $_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_REFERER'] 
- How can we submit a form without a submit button?
Java script submit() function is used for submit form without submit button on click call document.formname.submit()

- How can we get second of the current time using date function?
$second = date("s");?


php5 vs php7
php5 to php7 migration

- How to run the interactive PHP shell from the command line interface? 
	Just use the PHP CLI program with the option -a as follows:
	php -a

-  What type of operation is needed when passing values through a form or an URL? 

Answer:If we would like to pass values througn a form or an URL then we need to encode and to decode them using htmlspecialchars() and urlencode().

- How the result set of Mysql be handled in PHP? 

Answer:The result set can be handled using mysql_fetch_array, mysql_fetch_assoc, mysql_fetch_object or mysql_fetch_row.

- How is it possible to know the number of rows returned in result set? 

Answer:The function mysql_num_rows() returns the number of rows in a result set.

- Which function gives us the number of affected entries by a query? 

Answer:mysql_affected_rows() return the number of entries affected by an SQL query.

- What is the difference between mysql_fetch_object() and mysql_fetch_array()? 

Answer:The mysql_fetch_object() function collects the first single matching record where mysql_fetch_array() collects all matching records from the table in an array.

-  How Can We Know The Number Of Days Between Two Given Dates Using Php?

Answer :

Simple arithmetic:
$date1 = date('Y-m-d');
$date2 = '2006-07-01';
$days = (strtotime() - strtotime()) / (60 * 60 * 24);
echo "Number of days since '2006-07-01': $days";




- Strstr vs stristr
- pass by vlaue or reference with example 

- What Is The Difference Between The Functions Unlink And Unset?

Answer :

unlink() is a function for file system handling. It will simply delete the file in context.

unset() is a function for variable management. It will make a variable undefined.

-What Changes I Have To Do In Php.ini File For File Uploading?

Answer :

Make the following line uncomment like:
; Whether to allow HTTP file uploads.
file_uploads = On
; Temporary directory for HTTP uploaded files (will use system default if not
; specified).
upload_tmp_dir = C:\apache2triad\temp
; Maximum allowed size for uploaded files.
upload_max_filesize = 2M


- How to add 301 redirects in PHP?
You can add 301 redirect in PHP by adding below code snippet in your file.

header("HTTP/1.1 301 Moved Permanently"); 
header("Location: /option-a"); 
exit();

- clone 


Exception handling (throw, try, catch, finally)
Apache configurations (htaccess)
PHP routing
HTML entities
SQL injections
Composer
php.ini

php array functions
	count
	sizeof
	array_push
	array_pop
	array_shift
	sort
	array_key
	implode
	in_array
	array_values
	array_combine
	array_unique
	array_merge
	array_serach
	array_sum
	end
	extract

String Functions
	strlen
	str_replace


framework related questions
php error types
error handling
 Difference between array combine and array merge 
 2) Preg_replace 
 3) PEAR in php 
 4) REST VS AJAX 
 5) REST VS SOAP 
 7) sort a array with predefined function
		asort()
		arsort()
		ksort()
		krsort()
		uksort()
		sort()
		natsort()
		rsort() 
 8) Create a class and call add and subtract function 
 9) Mime type 
 10) Markup language used in rest web API 
 11) Why this error occur header already sent. 
 12) difference between PUT and POST request method 
 13) HTTP method supported by REST 
 18) MAGIC METHOD - https://www.fullstacktutorials.com/magic-methods-php-27.html
 20) PUT VS POST

$input = 'lorem lis pum';

for( $i = 0, $ilen = strlen( $input ), $result = array(); $i < $ilen; $i++ ) {
  $chr = $input[ $i ];
  // substituting the space with an underscore is not actually necessary
  if( $chr === ' ' ) {
    $chr = '_';
  }
  $result[ $chr ] = isset( $result[ $chr ] ) ? $result[ $chr ] + 1 : 1;
}


------------->
Consider the following code:

$str1 = 'yabadabadoo';
$str2 = 'yaba';
if (strpos($str1,$str2)) {
    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
} else {
    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
}
The output will be:

"yabadabadoo" does not contain "yaba"
Why? How can this code be fixed to work correctly?

solutions : 
The problem here is that strpos() returns the starting position index of $str2 in $str1 (if found), otherwise it returns false. So in this example, strpos() returns 0 (which is then coerced to false when referenced in the if statement). That’s why the code doesn’t work properly.

The correct solution would be to explicitly compare the value returned by strpos() to false as follows:

$str1 = 'yabadabadoo';
$str2 = 'yaba';
if (strpos($str1,$str2) !== false) {
    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
} else {
    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
}
Note that we used the !== operator, not just the != operator. If we use !=, we’ll be back to the problem that 0 is coerced to false when referenced in a boolean expression, so 0 != false will evaluate to false.



---------------------->

What will be the output of the code below and why?

$x = 5;
echo $x;
echo "<br />";
echo $x+++$x++;
echo "<br />";
echo $x;
echo "<br />";
echo $x---$x--;
echo "<br />";
echo $x;

= The output will be as follows:

5
11
7
1
5
Here’s are the two key facts that explain why:

The term $x++ says to use the current value of $x and then increment it. Similarly, the term $x-- says to use the current value of $x and then decrement it.
The increment operator (++) has higher precedence then the sum operator (+) in order of operations.
With these points in mind, we can understand that $x+++$x++ is evaluated as follows: The first reference to $x is when its value is still 5 (i.e., before it is incremented) and the second reference to $x is then when its value is 6 (i.e., before it is again incremented), so the operation is 5 + 6 which yields 11. After this operation, the value of $x is 7 since it has been incremented twice.

Similarly, we can understand that $x---$x-- is evaluated as follows: The first reference to $x is when its value is still 7 (i.e., before it is decremented) and the second reference to $x is then when its value is 6 (i.e., before it is again decremented), so the operation is 7 - 6 which yields 1. After this operation, the value of $x is back to its original value of 5, since it has been incremented twice and then decremented twice.


------>
What will be the values of $a and $b after the code below is executed? Explain your answer.

$a = '1';
$b = &$a;
$b = "2$b";




--------------------------------------------------------------- 
Mysql 
---------------------------------------------------------------

Basics
----------
- What is the default port for MySQL Server? - 3306

Primary Key and Unique Key
how many unique key we can define for a table ? 
ACID 
Normalization - avoid redudant data
	1 NF
	2 NF
	3 NF

JOIN
	INNER JOIN
	LEFT JOIN
	RIGHT JOIN
	CROSS JOIN
	SELF JOIN - same table join

indexes - What and how it works ? 
	Types of indexes
		primary index
		unique index
		index

Group BY 
Where and Having
Having
SQL Injection
How to break query ?
Optomise datbase / Query optimization, 
	SELECT required columns
	CREATE indexes
	User limit Wherever 
	DB cache
	Don't use wildcard char if possible user regex
	Use data type char if possible


- What is the difference between CHAR and VARCHAR ?

- Trigger - How many TRIGGERS are possible in MySql
	BEFORE
	AFTER

- ENUM vs SET differenece
	ENUM = radio fields (only accepted values are those listed, may only choose one)
	SET = checkbox fields (only accepted values are those listed, may choose multiple)


Stored Procedures vs sFunctions

Difference between RDBMS and NoSql

Mysql engines
Mysam VS Inno Db 

Views
DML
DDL
what is layers in mysql , 
myisam VS innodb , 
master slave, 

datalayers
What is RDBMS? Explain its features
clustering
UNION
UNION vs UNION ALL
mongodb vs rdbms



MySql Queries related
------------------------------
- DROP multiple table 
	DROP TABLE IF EXISTS B,C,A;
- Find the second largest of a table value / Second highest salary? 
	LIMIT(n-1,1)
	SELECT * FROM Table group by salary ORDER BY NumericalColumn DESC LIMIT (n-1, 1); 

- Get all second or nth highest salary with employee name,salary and email/contact

- Delete duplicate records from table and keep last samller
	DELETE t1 
	FROM contacts t1
	INNER JOIN contacts t2 
	WHERE
		t1.id < t2.id AND 
		t1.email = t2.email;

- How do I copy/clone/duplicate the data, structure and indexes of a MySQL table to a New Table?

- Handle one million user inputs/request(fetch form db) in a seconds ?

- Complex mysql query 

How to store picture file in the database. What Object type is used?
What are the common MySQL functions?
	GROUP_CONCAT
	DATE
	CONCAT
	AVG
	MAX
	SUM


What are HEAP Tables?
What is the syntax for concatenating tables in MySQL?
How to use the MySQL slow query log?
	Information that is provided on the slow query log could be huge in size. The query could also be listed over thousand times. In order to summarize the slow query log in an informative manner one can use the third party tool “pt-qury-digest”.

How can you change the root password if the root password is lost?	
  In such cases when the password is lost the user should start the DB with – skip-grants-table and then change the password. Thereafter with the new password the user should restart the DB in normal mode.

What is the difference between DELETE TABLE and TRUNCATE TABLE commands in MySQL? 
MySQL recursive functions
Batch processing
how to find slow queries and optimize them ? 


---------------------------------------------------------------
Others
---------------------------------------------------------------
Some logic where user selects from a drop down, so that it should display records which is related to 4 tables. Submit through ajax & display the result.
API integration,



---------------------------------------------------------------
Security
---------------------------------------------------------------
https://www.geeksforgeeks.org/is-your-web-application-secure-enough-think-again/
Cross site scripting
CSRF
SQL Injection
- how to implement Security in app 
https://www.toptal.com/security/interview-questions
- You find PHP queries overtly in the URL, such as /index.php=?page=userID. What would you then be looking to test?
		This is an ideal situation for injection and querying. If we know that the server is using a database such as SQL with a PHP controller, it becomes quite easy. We would be looking to test how the server reacts to multiple different types of requests, and what it throws back, looking for anomalies and errors.

		One example could be code injection. If the server is not using authentication and evaluating each user, one could simply try /index.php?arg=1;system(‘id’) and see if the host returns unintended data.

- You find yourself in an airport in the depths of of a foreign superpower. You’re out of mobile broadband and don’t trust the WI-FI. 
What do you do? Further, what are the potential threats from open WI-FIs?

	Ideally you want all of your data to pass through an encrypted connection. This would usually entail tunneling via SSH into whatever outside service you need, over a virtual private network (VPN). Otherwise, you’re vulnerable to all manner of attacks, from man-in-the-middle, to captive portals exploitation, and so on.


---------------------------------------------------------------
Server Related
---------------------------------------------------------------
 3) Server commands TOP , one , c
    cp
    sep
    chomd

 sorting techniches
 solar / elasticsearch
 delete duplicate records 
