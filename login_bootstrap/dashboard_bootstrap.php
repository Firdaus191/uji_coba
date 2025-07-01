<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - PDI</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/lottie-web@5.12.2/build/player/lottie.min.js"></script>
  <style>
    body {
      padding-top: 70px;
      background-color: var(--bs-body-bg);
      color: var(--bs-body-color);
    }

    .sidebar {
      height: 100vh;
      padding-top: 1rem;
      background-color: var(--bs-body-bg);
      border-right: 1px solid var(--bs-border-color);
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
    }

    .nav-link {
      font-weight: 500;
      color: #333;
    }

    .nav-link.active,
    .nav-link:hover {
      color: #0d6efd;
    }

    main {
      background-color: var(--bs-body-bg);
      color: var(--bs-body-color);
      border-radius: 8px;
      padding: 2rem;
      margin-top: 1rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    #editUserSection {
      background-color: var(--bs-body-bg);
      color: var(--bs-body-color);
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .navbar-brand {
      font-size: 1.25rem;
    }

    .theme-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }

    body.theme-transition {
      transition: background-color 0.6s ease, color 0.6s ease;
      transform: scale(0.98);
      filter: blur(2px);
      opacity: 0.5;
    }

    body.theme-final {
      transform: scale(1);
      filter: blur(0);
      opacity: 1;
      transition: all 0.5s ease-in-out;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm px-3">
    <a class="navbar-brand fw-semibold me-4 d-flex align-items-center" href="#">
      <img src="pdi.png" alt="Logo" width="40" height="40" class="me-2">
      <span>PDI Perjuangan</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
      aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <form class="d-flex ms-auto me-3 w-50">
        <input class="form-control form-control-dark" type="search" placeholder="Cari data..." aria-label="Search">
      </form>

      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span>Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#" onclick="toggleEditUser()">Edit User</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="#" onclick="logout()">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar position-fixed">
        <div class="pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#" onclick="kembaliKeDashboard()">
                <i data-feather="home" class="me-2"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="showActivities()">
                <i data-feather="calendar" class="me-2"></i> Data Kegiatan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="showMembers()">
                <i data-feather="users" class="me-2"></i> Data Anggota
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="showElectionResults()">
                <i data-feather="bar-chart-2" class="me-2"></i> Hasil Pemilu
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="showDocuments()">
                <i data-feather="file-text" class="me-2"></i> Arsip & Dokumen
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="showSettings()">
                <i data-feather="settings" class="me-2"></i> Pengaturan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="toggleEditUser()">
                <i data-feather="user" class="me-2"></i> Edit User
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="#" onclick="logout()">
                <i data-feather="log-out" class="me-2"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main id="dashboardContent" class="ms-md-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
        <h2>Kursi DPRD Kota Semarang – PDI Perjuangan</h2>
        <div class="table-responsive small">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Total Kursi DPRD Kota Semarang</td>
                <td>50</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Kursi yang Dikuasai PDI‑P</td>
                <td>14</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Kursi PDI‑P Dari Total (%)</td>
                <td>28%</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Pimpinan DPRD — Ketua</td>
                <td>Kadar Lusman (PDI‑P)</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
      <div id="editUserSection" class="ms-md-auto col-lg-10 px-md-4" style="display: none;">
        <h4>Edit User</h4>
        <form id="editUserForm" style="max-width: 400px;">
          <div class="mb-3">
            <label for="editUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="editUsername" required>
          </div>
          <div class="mb-3">
            <label for="editPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="editPassword" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <div id="saveAlert" class="alert alert-success mt-3 fade show" style="display: none;">
          User berhasil diubah!
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>

  <script>
    feather.replace();
  </script>

  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [{
          data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false,
        }
      }
    });
  </script>

  <script>
    if (sessionStorage.getItem("loggedIn") !== "true") {
      window.location.href = "index.html";
    }

    function logout() {
      sessionStorage.removeItem("loggedIn");
      window.location.href = "logout-bootstrap.php";
    }

    function toggleEditUser() {
      const dashboard = document.getElementById("dashboardContent");
      const editSection = document.getElementById("editUserSection");

      const userData = JSON.parse(localStorage.getItem("userData")) || {
        username: "usm",
        password: "123"
      };
      document.getElementById("editUsername").value = userData.username;
      document.getElementById("editPassword").value = userData.password;

      dashboard.style.display = "none";
      editSection.style.display = "block";
    }

    function kembaliKeDashboard() {
      document.getElementById("editUserSection").style.display = "none";
      document.getElementById("dashboardContent").style.display = "block";
    }

    document.getElementById("editUserForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const newUser = {
        username: document.getElementById("editUsername").value.trim(),
        password: document.getElementById("editPassword").value.trim()
      };
      localStorage.setItem("userData", JSON.stringify(newUser));
      document.getElementById("saveAlert").style.display = "block";
      setTimeout(() => {
        document.getElementById("saveAlert").style.display = "none";
      }, 2000);
    });
  </script>

  <div class="theme-toggle">
    <select id="themeSelect" class="form-select form-select-sm" onchange="changeTheme(this.value)">
      <option value="auto" selected>🌗 Auto</option>
      <option value="light">☀️ Light</option>
      <option value="dark">🌙 Dark</option>
    </select>
  </div>

  <div id="lottie-theme-switch" style="display:none; width:80px; height:80px; position:fixed; bottom:70px; right:20px; z-index:1001;"></div>

  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.body.classList.add("loaded");
    });

    function changeTheme(value) {
      const html = document.documentElement;
      const body = document.body;
      const container = document.getElementById("lottie-theme-switch");

      const lottieUrl = value === 'dark' ? 'anim.json' : 'lottie_loading.json';

      container.style.display = 'block';

      const anim = lottie.loadAnimation({
        container: container,
        renderer: 'svg',
        loop: false,
        autoplay: true,
        path: lottieUrl
      });

      body.classList.add("theme-transition");

      setTimeout(() => {
        html.setAttribute('data-bs-theme', value);
        localStorage.setItem('theme-mode', value);
      }, 100);

      setTimeout(() => {
        body.classList.remove("theme-transition");
      }, 400);

      setTimeout(() => {
        anim.destroy();
        container.style.display = 'none';
      }, 2000);
    }

    window.addEventListener("load", () => {
      const saved = localStorage.getItem('theme-mode');
      if (saved) {
        document.documentElement.setAttribute('data-bs-theme', saved);
        document.getElementById('themeSelect').value = saved;
      }
    });
  </script>
</body>

</html>