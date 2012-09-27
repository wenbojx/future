<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
  <title></title> 
</head> 
<body> 
<div id="a"></div> 
<script type="text/javascript"> 
function a(){
 document.getElementById("a").innerHTML="aaa";
 document.getElementById("a").innerHTML+="wait 6 seconds later";
 setTimeout("b('aaa')",6000);
}
function b(c){
 document.getElementById("a").innerHTML+="cccccc"+c;
}
a();
</script> 
</body> 
</html> 