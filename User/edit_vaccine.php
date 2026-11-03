<?php
session_start();
include '../db/db.php';


$id = $_GET['id'];

/* GET DATA */
$result = mysqli_query($conn, "SELECT * FROM vaccines WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

/* UPDATE */
if(isset($_POST['update'])){

    $name = $_POST['vaccine_name'];
    $date = $_POST['date_given'];

    // AUTO NEXT SCHEDULE
    $next = date('Y-m-d', strtotime($date . ' +21 days'));

    mysqli_query($conn,
        "UPDATE vaccines 
         SET vaccine_name='$name',
             date_given='$date',
             next_schedule='$next'
         WHERE id='$id'"
    );

    header("Location: view.php?pet_id=" . $row['pet_id']);
}
?>
<title>Edit_vaccine</title>
<link rel="stylesheet" href="users.css">
<!-- ========================= -->
<!-- SIDEBAR -->
<!-- ========================= -->
<div class="sidebar">
    <h1>🐾 Pet Care</h1>

    <a href="user_dashboard.php">Dashboard</a>
    <a href="add_pet.php">Add Pet</a>
    <a href="my_pet.php">My Pets</a>
     <a href="../Account/logout.php">Logout</a>
</div>
<div class="main">
<div class = "page-title">
    <h2>💉 Edit Vaccine</h2>
    </div>


        <form method="POST">

            <div class="form-group">
                <label>Vaccine Name</label>
                <input type="text" name="vaccine_name"
                       value="<?php echo $row['vaccine_name']; ?>">
            </div>

            <div class="form-group">
                <label>Date Given</label>
                <input type="date" name="date_given"
                       value="<?php echo $row['date_given']; ?>">
            </div>

            <button name="update">Update Vaccine</button>

        </form>

    </div>

</div>