<header class="d-flex justify-content-between align-items-center mb-4">
    <h1>Admin Dashboard</h1>

    <div class="d-flex align-items-center gap-3">
        <span>Welcome,  {{ Auth::user()->name }}</span>

        <a href="#" class="btn btn-outline-danger btn-sm"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>
