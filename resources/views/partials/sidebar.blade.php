<!-- Sidebar Navigation -->
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
        Manage Blogs
    </a>

      <a href="{{ route('admin.blogs.contacts') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
      Contacts Query
    </a>

     <a href="{{ route('admin.blogs.podcasts') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
      Podcasts Query
    </a>

    
</div>     
<!-- ///// -->
