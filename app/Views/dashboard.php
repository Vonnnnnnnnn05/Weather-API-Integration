<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Weather Favorites</title>

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

        .nav-link:hover {
            background: #e0dfdb;
        }

        .nav-link.active {
            background: #3a3a3a;
            color: #fff;
            font-weight: 600;
        }

        /* Page container */
        .container {
            max-width: 1050px;
            margin: 0 auto;
            padding: 28px 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        h1 {
            font-size: 26px;
            margin: 0 0 4px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 14px;
            color: #6b6b6b;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 13px;
            border-radius: 8px;
            border: 1px solid #cfcfcb;
            background: #ffffff;
            color: #333;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn:hover {
            background: #3a3a3a;
            color: #fff;
            border-color: #3a3a3a;
        }

        .btn-danger {
            border-color: #b9b9b5;
        }

        /* Flash */
        .flash {
            background: #eef6ef;
            border: 1px solid #cfe6d2;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        /* Card Table */
        .card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e3e0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background: #fafafa;
        }

        th {
            text-align: left;
            padding: 14px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #666;
        }

        td {
            padding: 14px;
            border-top: 1px solid #eee;
            vertical-align: top;
        }

        tr:first-child td { border-top: none; }

        .city {
            font-weight: 600;
        }

        .country {
            display: inline-block;
            padding: 2px 8px;
            font-size: 11px;
            border-radius: 999px;
            background: #ecebe8;
            color: #555;
        }

        .weather {
            line-height: 1.45;
        }

        .muted {
            color: #777;
            font-size: 13px;
        }

        .actions {
            white-space: nowrap;
        }

        .actions a + a {
            margin-left: 6px;
        }

        .empty {
            text-align: center;
            padding: 40px 0;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 700px) {
            .toolbar {
                flex-direction: column;
                align-items: flex-start;
            }
            h1 { font-size: 22px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="brand">Weather Tracker</div>
    <div class="nav-group">
        <a class="nav-link active" href="<?= base_url('weather'); ?>">Weather</a>
        <a class="nav-link" href="<?= base_url('weather/analytics'); ?>">Analytics</a>
        <a class="nav-link" href="<?= base_url('logout'); ?>">Logout</a>
    </div>
</header>

<main class="container">

    <div class="header">
        <h1>Saved Cities</h1>
        <div class="subtitle">Current weather pulled from an external API</div>
    </div>

    <div class="toolbar">
        <div></div>
        <a href="<?= base_url('weather/create'); ?>" class="btn">Add City</a>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="flash"><?= esc(session('message')) ?></div>
    <?php endif; ?>

    <?php if (empty($cities)): ?>
        <div class="empty">No cities added yet.</div>
    <?php else: ?>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Weather</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cities as $city): ?>
                    <tr>
                        <td><?= esc($city['id']) ?></td>
                        <td class="city"><?= esc($city['city_name']) ?></td>
                        <td>
                            <?php if ($city['country']): ?>
                                <span class="country"><?= esc(strtoupper($city['country'])) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="weather">
                            <?php if ($city['weather_ok']): ?>
                                <strong><?= esc($city['weather']['tempC']) ?>°C</strong>
                                <span class="muted">
                                    (feels <?= esc($city['weather']['feelsC']) ?>°C)
                                </span><br>
                                <?= esc($city['weather']['desc']) ?><br>
                                <span class="muted">
                                    Humidity <?= esc($city['weather']['humidity']) ?>% ·
                                    Wind <?= esc($city['weather']['windKmph']) ?> km/h
                                </span>
                            <?php else: ?>
                                <span class="muted">Weather unavailable</span>
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="<?= base_url('weather/edit/'.$city['id']); ?>" class="btn">Edit</a>
                            <a href="<?= base_url('weather/delete/'.$city['id']); ?>"
                               class="btn btn-danger"
                               onclick="return confirm('Delete this city?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</main>

</body>
</html>
