<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,intial-scale=1.0">
    <title>AAP Task</title>    
    <script src="assets/js/jquery-1.10.2.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script src="assets/js/bootstrap.js"></script>
</head>
<style type="text/css">
    body {
    font-family: "Avenir", "Montserrat";
    background-color: #232323;
    background-image: url("https://img.freepik.com/free-photo/abstract-polygonal-space-low-poly-dark-background-3d-rendering_7247-223.jpg?size=626&ext=jpg");
    background-attachment: fixed;
    background-origin: border-box;
    background-repeat: no-repeat;
    background-size: cover;
}
#imgg {
    margin-left: 90px;
    
  border: 1px solid #ccc;
  
  width: 180px;
  border-radius: 8px;
}
#imgg:hover{
    transform: scale(1.5);

}
tbody{
    background-color: transparent;
    width: 100%;
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    padding: 10px;
    text-align: center;
    border-radius: 10px;
    box-sizing: border-box;
    font-weight: bolder;
    color: white;
}
a{
     font-family: "Avenir", "Montserrat";
     font-size: 27px;
     text-decoration: none;
     letter-spacing: 10px;
     margin-left: 50px;
   
}
a:link {
  color: white;
}


a:visited {
  color: grey;
}

a:hover {
  color: hotpink;
  text-decoration: none;
}

a:active {
  color: blue;
}
#heading:hover{
    text-shadow:4px 4px 8px purple;
    font-size: 60px;
}

td {
  padding: 15px;
  text-align: left;

}
th{
    font-family:"Comic Sans MS", cursive, sans-serif;
    font-size: 15px;
    text-align: center;
    padding: 20px;

}
th:hover{
   
    transform: scale(1.2);
    text-shadow:4px 4px 8px hotpink;
}

tr:hover{
  background-color:rgba(255, 99, 71, 0.4);
  color:black;
}
th, td {
  border-bottom: 1px solid #ddd;
}

</style>
<body >

<?php

$url = 'http://demo4469839.mockable.io/influencers'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data, True); // decode the JSON feed
$charac = $characters['data']['allInfluencers'];
$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$limit = 20; // 20 rows per page
$offset = ($page - 1) * $limit;
$total_items = count($charac); // total items

   
$total_pages = ceil($total_items / $limit);
$final = array_splice($charac, $offset, $limit); 

?>

<p style="font-size: 50px; color: black; text-align: center; font-family:arial;text-shadow:4px 4px 8px purple" ><strong id="heading">Top Influencers</strong></p>


<?php for($x = 1; $x <= $total_pages; $x++): ?>
        <a href='final.php?page=<?php echo $x; ?>'><?php echo $x; ?></a>
                <?php endfor; ?>
        <br><br><br><br><br>
        <table border="0" cellpadding="20" align="center" cellspacing="30">
            <tbody >
                <tr><th>Username</th><th>Followers</th><th>Average Likes Ratio</th><th>Average Comments Ratio</th><th>Image</th></tr>
            </tbody>
            <tbody>
                    <?php 
                    for($i=0; $i<20; $i++)
                    { 
                        if(!empty($final[$i]['username'])){
                        $a = $final[$i]['username'];}
                        else{$a="";}
                        if(!empty($final[$i]['stats']['followerCount'])) {
                            $b=$final[$i]['stats']['followerCount'];
                        }
                        else {
                            $b="";
                        }
                        if(!empty($final[$i]['stats']['engagement']['avgLikesRatio'])) {
                            $c = $final[$i]['stats']['engagement']['avgLikesRatio']; }
                        else { $c="";}
                        if(!empty($final[$i]['stats']['engagement']['avgCommentsRatio'])) {
                            $d = $final[$i]['stats']['engagement']['avgCommentsRatio']; }
                        else { $d="";}
                        if(!empty($final[$i]['picture'])) {
                            $e = '<img id="imgg" src="'.$final[$i]['picture'].'" />'; }
                        else { $e="";}

                     ?>
        <tr>
                  <td><?php echo $a; ?></td>
                  <td><?php echo $b; ?></td>
                  <td><?php echo $c; ?></td>
                  <td><?php echo $d; ?></td>
                  <td><?php echo $e; ?></td>
              </tr>
          <?php } ?>
          </tbody>
</table>

</body>
</html>