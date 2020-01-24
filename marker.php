<?php

include "koneksi.php";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Select all the rows in the markers table

$query = "SELECT * FROM marker WHERE 1";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['nama']);
  $newnode->setAttribute("address",$row['alamat']);
  $newnode->setAttribute("telp",$row['telp']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
}

echo $dom->saveXML();

?>
