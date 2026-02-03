<?php
$name="vivek";
$age=19;
$salary=999000.00;
$isstudent=true;
$hobbies=array("eating","sleeping","coding");

echo "<h2>Variable Scope in PHP</h2>";

echo "name: $name\n" ."<br>";  
echo "age: $age\n". "<br>";
echo "salary: $salary"."<br>";
echo "isstudent:" .($isstudent ? "yes": "No")."<br>";

foreach($hobbies as $hobbie)
    {
        echo "$hobbie<br>";
    }

    echo "<hr>";

echo "Demonstartion of scope of variables in php";

$globalvar="I am  a global variable";
function Scope()
{
    global $globalvar;
    echo "<br>";
    echo "inside the functoin $globalvar";

}
scope();

echo "<h3>local scope</h3>";
function localscope()
{
    $localscope="hey hi i am local scope variable";
    echo "inside the function $localscope";
}
localscope();

echo "<h3>static variables</h3>";

function staticScope() {
    static $count = 0;
    $count++;
    echo "Static Count: $count <br>";
    }

staticScope();
staticScope();
staticScope();
echo "<hr>"
?>
