<?php 
    //1. DB Connection Open
    $conn = mysqli_connect('localhost','root','','oklabs_db') or die('Could not connect');

    $msg = '';
    //Check for the incomming student_sbmt_btn data
    if( isset($_GET['student_sbmt_btn']) ){

        // Always filter/Sanitize the incomming
        $name = mysqli_real_escape_string($conn,$_GET['name']);
        $surname = mysqli_real_escape_string($conn,$_GET['surname']);
        $address = mysqli_real_escape_string($conn,$_GET['address']);
        $mobileno = mysqli_real_escape_string($conn,$_GET['mobileno']);

        //2. Build the query
        $sql = "INSERT INTO students_tbl (`name`,`surname`,`address`,`mobno`) VALUES ('$name','$surname','$address','$mobileno')";

        //3. Execute the query
        mysqli_query($conn,$sql) or die(mysqli_error($conn));

        //4. Display the results

        $msg =  '<div class="alert alert-success" role="alert">
                Data Inserted successfully
              </div>';
    }

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD With Page Reload</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="text-center mt-5">Student Registration</h1>
                <?php 
                    echo $msg;
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Student Surname</label>
                        <input type="text" name="surname" class="form-control" id="surname" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Student Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="mobileno" class="form-label">Student Mobile No</label>
                        <input type="number" name="mobileno" class="form-control" id="mobileno" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <button type="submit" name="student_sbmt_btn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="container">
            <!-- Content here -->
            <?php 
                //2. Build the query
                $sql = 'SELECT * FROM students_tbl';
                
                
                //3. Execute the query
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                //Check for NOR (Number of Row)
                echo $nor = mysqli_num_rows($result);
                // If NOR > 0 Data Avaiable

                $row = '';
                if($nor > 0){
                    /**
                     * Associative Array
                     *  Key => Value
                     */
                   
                    while ($row2 = mysqli_fetch_assoc($result)) {
                        //echo '<pre>';
                        //var_dump($row2['id']);
                       // echo '</pre>';
                         $row .= '<tr>
                                            <td>'.$row2['id'].'</td>
                                            <td>'.$row2['name'].'</td>
                                            <td>'.$row2['surname'].'</td>
                                            <td>'.$row2['address'].'</td>
                                            <td>'.$row2['mobno'].'</td>
                                            <td>
                                                <button class="btn btn-success btn-sm">VIEW</button>    
                                                <button class="btn btn-info btn-sm">EDIT</button>    
                                                <button class="btn btn-danger btn-sm">DELETE</button>    
                                            </td>
                                        </tr>'; 

                    }//End of Looop
                    //print_r($row);   
                }
                

                //4. Display the results
            ?>
            <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $row; ?>
                </tbody>
                </table>
        </div>
        
            
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

<?php 
    //5. DB Connection CLose
    mysqli_close($conn);
?>