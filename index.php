<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Kustomisasi Sedikit agar persis gambar */
        body {
            background-color: #f0f2f5;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            border: none; /* Hilangkan border bawaan bootstrap card */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-control {
            padding: 12px;
        }
        .btn-primary {
            padding: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="flex-grow-1 d-flex align-items-center justify-content-center p-3">
        <div class="card login-card p-4">
            <div class="card-body">
                <h2 class="text-center fw-bold mb-4 text-dark">Log in</h2>
                
                <form action="config/proseslogin.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="visually-hidden">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="visually-hidden">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log in</button>
                </form>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-light pt-1 pb-1 mt-auto">
        <div class="container">
           
            <div class="text-center small text-secondary">
                &copy; 2026 Inventory System. Designed by Syech.
            </div>
        </div>
    </footer>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Login Gagal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Username atau password salah!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_GET['error'])) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorModalElement = document.getElementById('errorModal');
                    if(errorModalElement){
                        var errorModal = new bootstrap.Modal(errorModalElement);
                        errorModal.show();
                    }
                });
              </script>";
    }
    ?>
</body>
</html>