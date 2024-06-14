<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="../testCrud/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main class="content flex-fill">
        <section>
            <nav class="nav-content gap-5 pt-5">
                <div class="d-flex gap-2">
                    <div class="position-absolute top-0 start-50 translate-middle-x pt-3">
                        <h1 style="color: #404040;">DATA USER</h1>
                    </div>
                </div>
                </div>
            </nav>

            <!-- Form Add Data and Search -->
            <div class="row justify-content-between px-5">
                <div class="col-4 text-start pt-5">
                    <a href="add.php" class="btn btn-cancel btn-transparent" style="background-color: #404040;color: white;">+ Add Data</a>
                </div>
                <div class="col-4 text-end">
                    <form action="" method="GET" class="d-flex mb-3 pt-5">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search">
                        <button type="submit" class="btn btn-cancel px-4 btn-transparent float-end" style="background-color: #404040;color: white;" autocomplete="off" >Cari</button>
                    </form>
                </div>
            </div>

            <!--Table -->
            <div class="col">
                <div class="document-card px-5">
                    <div class="table-responsive mb-lg-4">
                        <table class="table">
                            <thead style="background-color: #404040; color: #FFFFFF;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #FFFFFF; color: #1e2122;">
                            <?php 
                                include 'connect.php';
                                $search = isset($_GET['search']) ? $_GET['search'] : '';
                                $total_perhalaman = 5; 
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $total_perhalaman;

                                
                                $query = "SELECT * FROM user WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR username LIKE '%$search%' OR gender LIKE '%$search%' LIMIT $offset, $total_perhalaman";
                                $query_run = mysqli_query($conn, $query);
                                $total_query = "SELECT COUNT(*) as total FROM user WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR username LIKE '%$search%' OR gender LIKE '%$search%'";
                                $total_result = mysqli_query($conn, $total_query);
                                $total_row = mysqli_fetch_assoc($total_result);
                                $total_records = $total_row['total'];
                                $total_pages = ceil($total_records / $total_perhalaman);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                         $counter = $offset + 1;
                                        foreach($query_run as $data)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $counter; ?></td>
                                                <td><?= $data['first_name'] . ' ' . $data['last_name']; ?></td>
                                                <td><?= $data['gender']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td>
                                                    <a href="form-update.php?user_id=<?= $data['user_id']; ?>" class="icon-link mx-2">
                                                        <img src="../testCrud/assets/icon/update.svg" alt="Update" />
                                                    </a>
                                                    <a href="#" onclick="confirmDelete(<?= $data['user_id']; ?>)" class="icon-link">
                                                    <img src="../testCrud/assets/icon/delete.svg" alt="Delete" />
                                                </td>
                                            </tr>
                                            <?php
                                            $counter++;
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5>No Record Found</h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <!-- Tombol Previous -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page - 1; ?>&search=<?= $search; ?>">Previous</a>
                                </li>
                                <!-- Nomor Halaman -->
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?= $i; ?>&search=<?= $search; ?>"><?= $i; ?></a>
                                    </li>
                                <?php } ?>
                                <!-- Tombol Next -->
                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page + 1; ?>&search=<?= $search; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success_delete')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        });
                    } else if (urlParams.has('failed_delete')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Data gagal dihapus'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php';
                            }
                        });
                    }
                });

                function confirmDelete(user_id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure you want to delete this data?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#404040',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete this data!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'delete.php?user_id=' + user_id;
                        }
                    });
                }
        </script>
</body>
</html>
