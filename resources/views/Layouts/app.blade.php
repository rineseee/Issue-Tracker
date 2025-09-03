<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Mini Issue Tracker')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f4f6f9;
      color: #111827;
      font-family: 'Inter', sans-serif;
      margin: 0;
    }

    .sidebar {
      background: #fff;
      min-height: 100vh;
      padding-top: 20px;
      border-right: 1px solid #e5e7eb;
      transition: left .3s ease, transform .3s ease;
      width: 240px;
    }

    .sidebar h4 {
      color: #3b82f6;
      padding-left: 20px;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .sidebar .nav-link {
      color: #374151;
      padding: 12px 20px;
      border-radius: 8px;
      margin: 4px 10px;
      font-weight: 500;
      transition: background .2s, color .2s;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background: #e5e7eb;
      color: #3b82f6;
    }


    .topbar {
      background: #fff;
      padding: 12px 20px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1049;
    }

    .user-info {
      color: #374151;
      font-size: .95rem;
    }

    .btn-logout {
      background: #ef4444;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 6px 14px;
      font-size: .9rem;
      transition: background .3s;
    }

    .btn-logout:hover {
      background: #dc2626;
      color: #fff;
    }


    .content-wrapper {
      padding: 25px;
      flex-grow: 1;
      min-height: calc(100vh - 60px);
    }


    .btn-toggle-floating {
      position: fixed;
      left: 12px;
      top: 12px;
      z-index: 1051;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      width: 44px;
      height: 44px;
      display: none;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
      cursor: pointer;
    }

    .btn-toggle-floating i {
      font-size: 1.3rem;
      color: #374151;
    }


    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .35);
      z-index: 1050;
      display: none;
    }

    .overlay.show {
      display: block;
    }


    @media (max-width: 992px) {
      .sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100vh;
        z-index: 1052;
      }

      .sidebar.active {
        left: 0;
      }

      .btn-toggle-floating {
        display: flex;
      }


      .content-wrapper {
        padding: 15px;
      }

      .topbar {
        padding-left: 60px;
      }

      body.no-scroll {
        overflow: hidden;
      }
    }

    @media (max-width: 576px) {
      .topbar {
        padding: 10px 16px 10px 64px;
      }

      .user-info {
        font-size: .85rem;
      }

      .btn-logout {
        font-size: .8rem;
        padding: 5px 10px;
      }

      .content-wrapper {
        padding: 10px;
      }
    }
  </style>
</head>

<body>


  <button class="btn-toggle-floating" id="toggleSidebarFloating" aria-label="Open menu">
    <i class="bi bi-list"></i>
  </button>
  <div class="overlay" id="sidebarOverlay"></div>

  <div class="d-flex">

    <div class="sidebar d-flex flex-column" id="sidebar">
      <h4>Issue Tracker</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('projects.index') }}" class="nav-link">Projects</a></li>
        <li class="nav-item"><a href="{{ route('issues.index') }}" class="nav-link">My Issues</a></li>
        <li class="nav-item"><a href="{{ route('tags.index') }}" class="nav-link">Tags</a></li>
      </ul>
    </div>


    <div class="flex-grow-1 d-flex flex-column">

      <div class="topbar">
        <span class="user-info">Hello, {{ Auth::user()->name ?? 'Guest' }} 👋</span>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="btn-logout d-flex align-items-center gap-1">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
      </div>


      <div class="content-wrapper">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const btnFloating = document.getElementById('toggleSidebarFloating');

    function openSidebar() {
      sidebar.classList.add('active');
      overlay.classList.add('show');
      document.body.classList.add('no-scroll');
      btnFloating.setAttribute('aria-label', 'Close menu');
      btnFloating.innerHTML = '<i class="bi bi-x-lg"></i>';
    }
    function closeSidebar() {
      sidebar.classList.remove('active');
      overlay.classList.remove('show');
      document.body.classList.remove('no-scroll');
      btnFloating.setAttribute('aria-label', 'Open menu');
      btnFloating.innerHTML = '<i class="bi bi-list"></i>';
    }
    function toggleSidebar() {
      if (sidebar.classList.contains('active')) closeSidebar();
      else openSidebar();
    }


    btnFloating.addEventListener('click', toggleSidebar);


    overlay.addEventListener('click', closeSidebar);


    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeSidebar();
    });


    document.querySelectorAll('#sidebar .nav-link').forEach(a => {
      a.addEventListener('click', () => {
        if (window.innerWidth <= 992) closeSidebar();
      });
    });


    window.addEventListener('resize', () => {
      if (window.innerWidth > 992) {
        overlay.classList.remove('show');
        document.body.classList.remove('no-scroll');
        sidebar.classList.remove('active');
        btnFloating.innerHTML = '<i class="bi bi-list"></i>';
        btnFloating.setAttribute('aria-label', 'Open menu');
      }
    });
  </script>
  @yield('scripts')
</body>

</html>