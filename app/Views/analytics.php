<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Weather Analytics</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, Segoe UI, sans-serif;
            background: #f6f5f3;
            color: #2c2c2c;
        }

        /* Navbar */
        .navbar {
            background: #fdfdfc;
            border-bottom: 1px solid #e2e2df;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #3a3a3a;
        }

        .nav-group {
            display: flex;
            gap: 6px;
            background: #efefec;
            padding: 4px;
            border-radius: 999px;
        }

        .nav-link {
            padding: 8px 14px;
            font-size: 13px;
            border-radius: 999px;
            text-decoration: none;
            color: #444;
            transition: all .2s ease;
        }

        .nav-link:hover { background: #e0dfdb; }

        .nav-link.active {
            background: #3a3a3a;
            color: #fff;
            font-weight: 600;
        }

        /* Container */
        .container {
            max-width: 1050px;
            margin: 0 auto;
            padding: 28px 20px;
        }

        .header {
            margin-bottom: 18px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        h1 {
            font-size: 24px;
            margin: 0 0 6px;
            font-weight: 750;
        }

        .subtitle {
            font-size: 14px;
            color: #6b6b6b;
            margin: 0;
        }

        .btn {
            padding: 9px 14px;
            border-radius: 10px;
            border: 1px solid #cfcfcb;
            background: #ffffff;
            color: #333;
            text-decoration: none;
            font-size: 13px;
            transition: all .2s ease;
            cursor: pointer;
        }

        .btn:hover {
            background: #3a3a3a;
            color: #fff;
            border-color: #3a3a3a;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr));
            gap: 14px;
            margin-top: 12px;
        }

        .card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e3e0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.04);
            padding: 16px 16px;
        }

        .card-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .10em;
            color: #6b6b6b;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 30px;
            font-weight: 800;
            color: #2c2c2c;
        }

        .card-sub {
            margin-top: 8px;
            font-size: 13px;
            color: #777;
            line-height: 1.35;
        }

        @media (max-width: 1100px) {
            .cards { grid-template-columns: repeat(2, minmax(200px, 1fr)); }
        }

        @media (max-width: 700px) {
            .container { padding: 16px; }
            h1 { font-size: 20px; }
            .cards { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="brand">Weather Tracker</div>
    <div class="nav-group">
        <a class="nav-link" href="<?= base_url('weather'); ?>">Weather</a>
        <a class="nav-link active" href="<?= base_url('weather/analytics'); ?>">Analytics</a>
        <a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
    </div>
</header>

<main class="container">

    <div class="header">
        <div>
            <h1>Analytics</h1>
            <p class="subtitle">Quick overview of saved cities and API status.</p>
        </div>

        <a href="<?= base_url('weather'); ?>" class="btn">Back to Weather</a>
    </div>

    <div class="cards">
        <div class="card">
            <div class="card-title">Total Cities</div>
            <div class="card-value"><?= esc($totalCities ?? 0) ?></div>
            <div class="card-sub">All saved favorites</div>
        </div>

        <div class="card">
            <div class="card-title">Weather OK</div>
            <div class="card-value"><?= esc($withWeather ?? 0) ?></div>
            <div class="card-sub">Successful API responses</div>
        </div>

        <div class="card">
            <div class="card-title">Weather Errors</div>
            <div class="card-value"><?= esc($failedWeather ?? 0) ?></div>
            <div class="card-sub">Failed / unavailable</div>
        </div>

        <div class="card">
            <div class="card-title">Unique Countries</div>
            <div class="card-value"><?= esc($uniqueCountries ?? 0) ?></div>
            <div class="card-sub">Distinct country codes</div>
        </div>
    </div>

</main>

</body>
</html>
