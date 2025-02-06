<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'CRM'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        .navbar-custom {
            background-color: #1a252f;
        }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link {
            color: #ecf0f1;
        }
        .navbar-custom .nav-link:hover {
            color: #18bc9c;
        }
        .card {
            background-color: #34495e;
            color: #ecf0f1;
        }
        .btn-primary {
            background-color: #18bc9c;
            border: none;
        }
        .btn-primary:hover {
            background-color: #148f77;
        }
        .form-control {
            background-color: #3a5068;
            color: #ecf0f1;
            border: 1px solid #18bc9c;
        }
        .form-control:focus {
            background-color: #3a5068;
            color: #ecf0f1;
            border: 1px solid #18bc9c;
            box-shadow: none;
        }
        .text-muted {
            color: #bdc3c7 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/crm/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/crm/customer/login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

