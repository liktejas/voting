<?php
    session_start();
    include 'conn.php';
    if(empty($_SESSION['voter_name']))
    {
        header("Location:index.php");
    }
    $voter_id = $_SESSION['voter_id'];
    $check_vote = "SELECT * FROM votes WHERE voter_id='$voter_id'";
    $check_vote_result = mysqli_query($con,$check_vote);
    if($check_vote_result->num_rows > 0)
    {
        header("Location:voting_done.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>EVoting</title>
    <style>
        fieldset {
        background-color: #eeeeee;
        }

        legend {
        background-color: gray;
        color: white;
        padding: 5px 10px;
        }

        input {
        margin: 5px;
        }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">EVoting</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_url?>vlogout.php">Logout</a>
            </li>
        </ul>
    </div>
    </nav>
    
    <div class="container mt-3 border rounded">
        <h3><u><b>Terms and Conditions:</u></b></h3>
        <p class="text-justify" >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere saepe hic laborum temporibus deleniti quos, aperiam, rem vitae voluptatum impedit, molestias neque nihil eveniet ratione culpa. Necessitatibus, dolore quo! Fugit.
        Explicabo, velit enim aut soluta iusto repellat reprehenderit unde dignissimos aperiam consequuntur! Fugiat qui ratione iusto nihil error tempore ipsa obcaecati tenetur, dolorum aliquam voluptatem reiciendis unde nesciunt vero id!
        Enim delectus expedita pariatur placeat praesentium obcaecati, odio reiciendis, maiores et necessitatibus voluptate quis rem? Cum ipsam, asperiores repellendus adipisci, voluptates accusantium iste aliquam provident voluptatum consequuntur dicta placeat dolorem!
        Accusamus deleniti, pariatur eaque a voluptate sed ut praesentium quo tempora esse, iste doloremque suscipit vel maiores aperiam maxime optio quidem ipsum ipsam nostrum. Tempora soluta voluptatum quo quidem eius.
        Obcaecati inventore est minus illo? Perspiciatis laboriosam unde doloremque iste beatae sunt enim porro doloribus natus est quasi quisquam tempore, laborum facere quia dolore, quas dolor libero blanditiis ut accusamus?
        Libero, dicta. Atque recusandae aliquid esse sed! Neque, aliquam quaerat nobis distinctio autem consequuntur labore eaque laborum quos ex quod molestias ullam ipsam quidem voluptas perspiciatis quo qui fugit quibusdam.
        Voluptates inventore optio incidunt neque aliquam, quibusdam debitis deserunt reprehenderit doloremque, odio omnis numquam iure laboriosam exercitationem voluptatum culpa facere unde temporibus necessitatibus recusandae? Neque illo esse quos eos saepe.
        Cupiditate dicta quas sint id. Minus iure nemo reprehenderit dolor ut unde nulla commodi aliquam accusantium architecto libero quod enim ratione magni nostrum doloremque rem iusto, labore similique autem hic!
        Amet maxime excepturi aliquid alias, est esse sapiente ab sit dolorum debitis fugiat quibusdam aperiam. Possimus aliquam molestias consequatur eos quia in exercitationem eveniet. Ipsam asperiores iste aliquam. Aut, vel.
        Tempora exercitationem perferendis ducimus facere laborum sint nesciunt rem, voluptatem reiciendis ab. Nesciunt architecto consectetur dignissimos? Et similique reiciendis, quibusdam tempora accusamus optio, minima a, voluptatibus nisi recusandae iste unde?</p>
        <input type="checkbox" name="checkbox" id="checkbox"><b>I agree to the Terms and Conditions</b>
        <div class="text-center">
            <a href="voting_page.php"><button class="btn btn-primary mb-3" id="agree">I agree</button></a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#agree').attr('disabled', true);
            $('#checkbox').click(function(){
            if($(this).prop("checked") == true){
                $('#agree').attr('disabled', false);
            }
            else if($(this).prop("checked") == false){
                $('#agree').attr('disabled', true);
            }
            });
        });
            
    </script>
</body>
</html>