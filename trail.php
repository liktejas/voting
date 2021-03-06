<?php

include 'conn.php';
// $fetch_candidate_data = "SELECT * FROM candidates";
// $result_candidate_data = mysqli_query($con, $fetch_candidate_data);
// while($res = mysqli_fetch_array($result_candidate_data))
// {
//     echo $res['id'].'<br>';
//     echo $res['can_id'].'<br>';
//     echo $res['can_name'].'<br>';
//     echo $res['can_image'].'<br>';
//     echo $res['can_party_symbol'].'<br>';
// }

// $id= 1;
// $q = "SELECT can_image, can_party_symbol FROM candidates WHERE id='$id'";
// $res = mysqli_query($con,$q);
// $r = mysqli_fetch_array($res);
// echo $r['can_image'].'<br>'. $r['can_party_symbol'];


$fetch_candidate_data = "SELECT * FROM candidates";
$result_candidate_data = mysqli_query($con, $fetch_candidate_data);
if(mysqli_num_rows($result_candidate_data) > 0)
{
    while($res = mysqli_fetch_array($result_candidate_data))
    {
        echo $res['id'];
    }
}
else
{
    echo 'no data found';
}


?>