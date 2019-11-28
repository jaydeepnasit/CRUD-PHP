<?php

require_once 'config/CUFunction.php';
$UDF_call = new CUFunction();
$counter = 1;
$fetch_rec = $UDF_call->select('userdata');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>
    
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <h1 class="heading">CRUD Application</h1>
        </div>
        <div class="row justify-content-center">
            <a class="first-btn-sty btn-dark" href="insert.php">Add Record</a>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <table class="table table-striped" style="vertical-align: middle; text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">BOD</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Hobby</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($fetch_rec){ foreach($fetch_rec as $se_data) { ?> 
                    <tr>
                        <th scope="row"><?php echo $counter; $counter++; ?></th>
                        <td><?php echo $se_data['u_name']; ?></td>
                        <td><?php echo $se_data['u_email']; ?></td>
                        <td><?php echo $se_data['u_country']; ?></td>
                        <td><?php echo $se_data['u_bod']; ?></td>
                        <td><?php echo $se_data['u_gender']; ?></td>
                        <td><?php echo $se_data['u_skill']; ?></td>
                        <td>
                            <a href="update.php?uid=<?php echo $se_data['u_id']; ?>" class="btn btn-sm btn-primary">Update</a>
                            <a href="delete.php?did=<?php echo $se_data['u_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php }}else{ echo "<h1 class='w-100 text-center'>No Record Found</h1>"; } ?> 
                </tbody>
              </table>            
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>