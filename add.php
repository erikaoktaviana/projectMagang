<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data User</title>
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
                        <h1 style="color: #404040;">ADD DATA USER</h1>
                    </div>
                </div>
            </nav>
            <div class="co-12 py-5">
                <div class="row justify-content-center mt-5 px-5">
                    <div class="col-lg-8 px-4">
                        <form action="save.php" method="POST">
                            <div class="row">
                                <div class="col mb-4">
                                    <input type="text" name="first_name" class="form-control" placeholder="First name" aria-label="First name" autocomplete="off" required>
                                </div>
                                <div class="col mb-4">
                                    <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-label="Last name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <select name="gender" class="form-select" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" autocomplete="off" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" autocomplete="off" required>
                            </div>
                            <div class="mb-4">
                                <button type="submit" name="submit" class="btn btn-cancel px-4 btn-transparent mb-2 float-end" style="background-color: #404040;color: white;">Save</button>
                                <a href="index.php" class="btn btn-cancel btn-transparent" style="background-color: #DDDDDD;color: grey;">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('success')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data saved successfully',
                        confirmButtonColor: '#404040'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php';
                        }
                    });
                } else if (urlParams.has('failed')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data Failed to Save'
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
