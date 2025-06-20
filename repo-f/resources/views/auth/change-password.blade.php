<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h2 class="mb-4 text-primary">🔐 Change Password</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="/change-password">
            @csrf

            <div class="mb-3">
                <label class="form-label">Current Password:</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm New Password:</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Change Password</button>
            <a href="/dashboard" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
