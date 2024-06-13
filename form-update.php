<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Update Data User</title>
		<link rel="stylesheet" href="style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
	<body>
		<main class="content flex-fill">
			<section>
				<nav class="nav-content gap-5 mb-lg-4">
					<div class="d-flex gap-2 align-items-center">
                        <div class="position-absolute top-0 start-50 translate-middle-x pt-3">
                            <h1 style="color: #404040;">UPDATE DATA USER</h1>
                        </div>
					</div>
					</div>
				</nav>
				<div class="co-12 py-5">
				<div class = "row justify-content-center mt-5 px-5">
                <div class="col-lg-8 px-4">
                        <?php
                         include 'connect.php';
                        if(isset($_GET['user_id']))
                        {
                            $user_id=$_GET['user_id'];
                            $query = "SELECT * FROM user WHERE user_id='$user_id' ";
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0)
                            {
                                $data = mysqli_fetch_array($result);
                                ?>
                                <form action="update.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>">
                                    <div class="row">
                                        <div class="col mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="<?=$data['first_name'];?>" autocomplete="off">
                                        </div>
                                        <div class="col mb-4">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="<?=$data['last_name'];?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-select" required>
                                            <option value="Female" <?php if($data['gender'] == "Female") echo 'selected'; ?>>Female</option>
                                            <option value="Male" <?php if($data['gender'] == "Male") echo 'selected'; ?>>Male</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" value="<?=$data['username'];?>" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="pass">Password</label>
                                        <input type="text" name="password" value="<?=$data['password'];?>" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" name="update" class="btn btn-cancel btn-transparent mb-2 float-end" style="background-color: #404040;color: white;">Update</button>
                                        <a href="index.php" class="btn btn-cancel btn-transparent" style="background-color: #DDDDDD;color: grey;">Cancel</a>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
					</div>
				</div>
			</div>
		</section>
		</main>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('success_update')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data successfully updated',
                        confirmButtonColor: '#404040'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                    });
                } else if (urlParams.has('failed_update')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data Failed to Update'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                    });
                }
            });
        </script>
	</body>
</html>
