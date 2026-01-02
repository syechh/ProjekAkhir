
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style-login.css">
</head>
<body>
<div class="form-structor">
        <div class="login slide-up">
            <div class="center">
                <h2 class="form-title" id="login">Log in</h2>
                <form action="config/proseslogin.php" method="POST">
                    <div class="form-holder">
                        <input type="text" class="input" name="username" placeholder="Username" required />
                        <br>
                        <input type="password" class="input" name="password" placeholder="Password" required />
                    </div>
                    <button class="submit-btn">Log in</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Model untuk pesan error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Login Gagal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Username atau password salah!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../js/js-login.js"></script>

    <!-- Script untuk menampilkan modal jika ada error -->
    <?php
    if (isset($_GET['error'])) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                });
              </script>";
    }
    ?>
</body>
</html>