<html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'zip_code.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}

</script>

</head>
<body>

 <select onchange="fetch_select(this.value);">
  <option>Select Zip Code</option>
  <?php
  include('../dbconfig.php');
  $query ="select zip_code from zip_code group by zip_code"; 
  $select=$conn->query($query);
  
  while($row=$select->fetch_array())
  {
   echo "<option>".$row['zip_code']."</option>";
  }
 ?>
 </select>

 <select id="new_select">
 </select>
 
 
<?php
 $rest = substr("8801747423861", 0, -8);  // returns "abcde"
 echo $rest;
 echo "<br>";
 $pizza  = "33.1480869,73.7070571";
 $pieces = explode(',', $pizza);
 echo $pieces[0]; // piece1
 echo "<br>";
 echo $pieces[1]; // piece2
 echo  '<a href="http://maps.google.com/?q='.$pieces[0].','.$pieces[1].'">GOOGLE MAP</a>';

?>
 
</body>
</html>