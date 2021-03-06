<?php
    session_start();
    include 'conn.php';
    if(empty($_SESSION['superadmin_name']))
    {
        header("Location:superadmin.php");
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet "href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>EVoting - Control</title>
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
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#addcandidatemodal">Add Candidate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base_url?>alogout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--Add Candidate Modal -->
    <div class="modal fade" id="addcandidatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Candidate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="can_id">Candidate ID:</label>
                <input type="text" name="can_id" id="can_id" class="form-control" placeholder="Candidate ID" required>
            </div>
            <div class="form-group">
                <label for="can_name">Candidate Name:</label>
                <input type="text" name="can_name" id="can_name" class="form-control" placeholder="Candidate Name" required>
            </div>
            <div class="form-group">
                <label for="can_party">Candidate Party Image:</label>
                <input type="file" name="can_party" id="can_party" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="can_image">Candidate Image:</label>
                <input type="file" name="can_image" id="can_image" class="form-control" required>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_candidate" class="btn btn-primary">Add Candidate</button>
        </div>
        </form>
        </div>
    </div>
    </div>


    <!--Edit Candidate Modal -->
    <div class="modal fade" id="editcandidatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Candidate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="edit_can_id">Candidate ID:</label>
                <input type="text" name="can_id" id="edit_can_id" class="form-control" placeholder="Candidate ID" required>
            </div>
            <div class="form-group">
                <label for="edit_can_name">Candidate Name:</label>
                <input type="text" name="can_name" id="edit_can_name" class="form-control" placeholder="Candidate Name" required>
            </div>
            <div class="form-group">
                <label for="edit_can_party">Candidate Party Image:</label>
                <input type="file" name="can_party" id="edit_can_party" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_can_image">Candidate Image:</label>
                <input type="file" name="can_image" id="edit_can_image" class="form-control" required>
            </div>
            <input type="hidden" name="id" id="edit_id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit_candidate" class="btn btn-info">Edit Candidate</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    <!--Delete Candidate Modal -->
    <div class="modal fade" id="deletecandidatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Candidate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            Do you want to Delete this Candidate?
                        <input type="hidden" name="id" id="delete_id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="delete_candidate" class="btn btn-info">Delete Candidate</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    <!-- Add Candidate -->
    <?php
        if(isset($_POST['add_candidate']))
        {
            $can_id = $_POST['can_id'];
            $can_name = $_POST['can_name'];

            //Candidate Party Image
            $can_party = $_FILES['can_party'];
			$can_party_filename = $can_party['name'];
			$can_party_fileerror = $can_party['error'];
			$can_party_filetmp = $can_party['tmp_name'];

			$t=time();
			$d = date("Y-m-d",$t);
			$td = $t.$d;

			$can_party_filename1 = $td."_".$can_party_filename;

			$can_party_fileext = explode(".", $can_party_filename1);
			$can_party_filecheck = strtolower(end($can_party_fileext));

			$can_party_fileextstored = array('png','jpg','jpeg');

			if(in_array($can_party_filecheck, $can_party_fileextstored));
			{
				$can_party_destinationfile = 'profile/'.$can_party_filename1;
				move_uploaded_file($can_party_filetmp, $can_party_destinationfile);
				$can_party_img = $can_party_filename1;
            }

            //Candidate Image
            $can_image = $_FILES['can_image'];
			$can_image_filename = $can_image['name'];
			$can_image_fileerror = $can_image['error'];
			$can_image_filetmp = $can_image['tmp_name'];

			$t=time();
			$d = date("Y-m-d",$t);
			$td = $t.$d;

			$can_image_filename1 = $td."_".$can_image_filename;

			$can_image_fileext = explode(".", $can_image_filename1);
			$can_image_filecheck = strtolower(end($can_image_fileext));

			$can_image_fileextstored = array('png','jpg','jpeg');

			if(in_array($can_image_filecheck, $can_image_fileextstored));
			{
				$can_image_destinationfile = 'profile/'.$can_image_filename1;
				move_uploaded_file($can_image_filetmp, $can_image_destinationfile);
				$can_image_img = $can_image_filename1;
			}

            // echo $can_id.'  '.$can_name.'  '.$can_party_img.'  '.$can_image_img;
            $insert_candidate_data = "INSERT INTO candidates (can_id, can_name, can_image, can_party_symbol) VALUES ('$can_id','$can_name','$can_image_img','$can_party_img')";
            $insert_result = mysqli_query($con, $insert_candidate_data);
            // print_r($insert_result);
            if($insert_result == '1')
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Candidate Added Successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Add Candidate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    ?>
    <!-- Edit Candidate -->
    <?php
        if(isset($_POST['edit_candidate']))
        {
            $id = $_POST['id'];
            $can_id = $_POST['can_id'];
            $can_name = $_POST['can_name'];

            //Edit Candidate Party Image
            $can_party = $_FILES['can_party'];
			$can_party_filename = $can_party['name'];
			$can_party_fileerror = $can_party['error'];
			$can_party_filetmp = $can_party['tmp_name'];

			$t=time();
			$d = date("Y-m-d",$t);
			$td = $t.$d;

			$can_party_filename1 = $td."_".$can_party_filename;

			$can_party_fileext = explode(".", $can_party_filename1);
			$can_party_filecheck = strtolower(end($can_party_fileext));

			$can_party_fileextstored = array('png','jpg','jpeg');

			if(in_array($can_party_filecheck, $can_party_fileextstored));
			{
				$can_party_destinationfile = 'profile/'.$can_party_filename1;
				move_uploaded_file($can_party_filetmp, $can_party_destinationfile);
				$can_party_img = $can_party_filename1;
            }

            //Edit Candidate Image
            $can_image = $_FILES['can_image'];
			$can_image_filename = $can_image['name'];
			$can_image_fileerror = $can_image['error'];
			$can_image_filetmp = $can_image['tmp_name'];

			$t=time();
			$d = date("Y-m-d",$t);
			$td = $t.$d;

			$can_image_filename1 = $td."_".$can_image_filename;

			$can_image_fileext = explode(".", $can_image_filename1);
			$can_image_filecheck = strtolower(end($can_image_fileext));

			$can_image_fileextstored = array('png','jpg','jpeg');

			if(in_array($can_image_filecheck, $can_image_fileextstored));
			{
                $can_image_destinationfile = 'profile/'.$can_image_filename1;
                $q = "SELECT can_image, can_party_symbol FROM candidates WHERE id='$id'";
                $res = mysqli_query($con,$q);
                $r = mysqli_fetch_array($res);
                $old_can_image = $r['can_image'];
                $old_can_party_image = $r['can_party_symbol'];
                unlink('profile/'.$old_can_image);
                unlink('profile/'.$old_can_party_image);
				move_uploaded_file($can_image_filetmp, $can_image_destinationfile);
				$can_image_img = $can_image_filename1;
			}

            // echo $id.'  '.$can_id.'  '.$can_name.'  '.$can_party_img.'  '.$can_image_img;
            $update_candidate_data = "UPDATE candidates SET can_id='$can_id', can_name='$can_name', can_image='$can_image_img', can_party_symbol='$can_party_img' WHERE id='$id'";
            $update_result = mysqli_query($con, $update_candidate_data);
            // print_r($update_result);
            if($update_result == '1')
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Candidate Updated Successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Update Candidate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    ?>
    <!-- Delete Candidate -->
    <?php
        if(isset($_POST['delete_candidate']))
        {
            $id = $_POST['id'];
            $q = "SELECT can_image, can_party_symbol FROM candidates WHERE id='$id'";
            $res = mysqli_query($con,$q);
            $r = mysqli_fetch_array($res);
            $old_can_image = $r['can_image'];
            $old_can_party_image = $r['can_party_symbol'];
            unlink('profile/'.$old_can_image);
            unlink('profile/'.$old_can_party_image);
            $delete_query = "DELETE FROM candidates WHERE id='$id'";
            $delete_candidate = mysqli_query($con,$delete_query);
            if($delete_candidate == '1')
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Candidate Deleted Successfully</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            else
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Delete Candidate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    ?>
    <h1 class="text-center mt-2"><u>Candidate List</u></h1>
    <div class="container mt-3">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Candidate ID</th>
                    <th>Name</th>
                    <th>Candidate Image</th>
                    <th>Party Symbol</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetch_candidate_data = "SELECT * FROM candidates";
                $result_candidate_data = mysqli_query($con, $fetch_candidate_data);
                if(mysqli_num_rows($result_candidate_data) > 0)
                {
                    while($res = mysqli_fetch_array($result_candidate_data))
                    {
                ?>
                <tr>
                    <td class="pt-4"><h1><?php echo $res['id']?></h1></td>
                    <td class="pt-4"><h1><?php echo $res['can_id']?></h1></td>
                    <td><h3 class="pt-4"><?php echo $res['can_name']?></h3></td>
                    <td><img src="<?php echo $base_url?>profile/<?php echo $res['can_image'] ?>" alt="party" width="100"></td>
                    <td><img src="<?php echo $base_url?>profile/<?php echo $res['can_party_symbol'] ?>" alt="image" width="100"></td>

                    <td class="pt-4"><a href="" class="btn btn-lg btn-info" data-toggle="modal" data-target="#editcandidatemodal" data-id="<?php echo $res['id'] ?>" data-can_id="<?php echo $res['can_id']?>" data-can_name="<?php echo $res['can_name']?>" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>

                    <td class="pt-4"><a href="" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#deletecandidatemodal" data-id="<?php echo $res['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                <?php
                    }
                }
                else
                {
                ?>
                    <tr>
                        <td colspan="7"><?php echo 'No Data Available'?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editcandidatemodal').on('show.bs.modal', function (event) {
            // console.log("modal open");
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var can_id = button.data('can_id')
            var can_name = button.data('can_name')
           
            var modal = $(this)
            modal.find('.modal-body #edit_id').val(id)
            modal.find('.modal-body #edit_can_id').val(can_id)
            modal.find('.modal-body #edit_can_name').val(can_name)
            })

            $('#deletecandidatemodal').on('show.bs.modal', function (event) {
            // console.log("modal open");
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
           
            var modal = $(this)
            modal.find('.modal-body #delete_id').val(id)
            })
        });
    </script>
  </body>
</html>