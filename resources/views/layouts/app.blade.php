<!DOCTYPE html>
<html>
<head>
    <title>Bulk Email System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand">Bulk Email System</a>
        <div>
            <a href="/contacts" class="text-white me-3">Contacts</a>
            <a href="/templates" class="text-white me-3">Templates</a>
            <a href="/campaigns" class="text-white me-3">Campaigns</a>
            <a href="/logs" class="text-white">Logs</a>
        </div>
    </div>
</nav>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<script>
    setTimeout(function () {
        let alertBox = document.querySelector('.alert');
        if (alertBox) {
            alertBox.style.transition = "0.5s";
            alertBox.style.opacity = "0";
            setTimeout(() => alertBox.remove(), 500);
        }
    }, 3000);
</script>

<div class="container mt-5">
    @yield('content')
</div>

</body>
</html>