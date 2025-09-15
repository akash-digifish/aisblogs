<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1606761568499-6d7d5dbd74f1?auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .login-container {
      z-index: 1;
      position: relative;
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      border-radius: 10px;
    }

    .form-control:focus {
      box-shadow: none;
    }

    h3 {
      color: #333;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>

  <div class="login-container">
    <h3 class="text-center mb-4">Admin Login</h3>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          placeholder="Enter email"
          required
        />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Enter password"
          required
        />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
