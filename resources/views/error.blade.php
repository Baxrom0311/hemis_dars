<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('site/bootstrap.min.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('site/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: whitesmoke;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-card {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 500px;
        }

        .error-icon {
            font-size: 5rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .retry-btn {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="error-card">
    <i class="fas fa-exclamation-triangle error-icon"></i>
    <h2>Xatolik! HEMIS tizimi aktiv emas</h2>
    <p>Dars jadvalini ko'rish uchun HEMIS tizimidan ma'lumotlarni olib bo'lmadi. Iltimos keyinroq qayta urinib ko'ring </p>
    <button class="btn btn-primary retry-btn" onclick="window.location.reload();">Qayta urinish</button>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('site/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
