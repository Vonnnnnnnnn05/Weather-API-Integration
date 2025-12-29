<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add City</title>

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
            max-width: 760px;
            margin: 0 auto;
            padding: 28px 20px;
        }

        .header {
            margin-bottom: 18px;
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

        /* Form card */
        .card {
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e3e3e0;
            box-shadow: 0 6px 18px rgba(0,0,0,0.04);
            padding: 18px;
        }

        .row {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .10em;
            color: #666;
            margin-bottom: 6px;
            font-weight: 700;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 12px;
            border: 1px solid #d9d9d6;
            border-radius: 10px;
            font-size: 14px;
            background: #fff;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        input[type="text"]:focus {
            border-color: #3a3a3a;
            box-shadow: 0 0 0 3px rgba(58,58,58,0.12);
        }

        .hint {
            margin-top: 6px;
            font-size: 12px;
            color: #777;
        }

        .errors {
            background: #fff2f2;
            border: 1px solid #f0c6c6;
            color: #7b1f1f;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 6px;
        }

        .btn {
            padding: 10px 14px;
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

        @media (max-width: 700px) {
            .container { padding: 16px; }
            h1 { font-size: 20px; }
            .actions { flex-direction: column; align-items: stretch; }
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
        <h1>Add City</h1>
        <p class="subtitle">Save a city to track its live weather.</p>
    </div>

    <div class="card">
        <?php $errors = session('errors') ?? []; ?>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <strong>Please fix the following:</strong>
                <ul style="margin:8px 0 0; padding-left: 18px;">
                    <?php foreach ($errors as $e): ?>
                        <li><?= esc($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('weather/store'); ?>" method="post">
            <?= csrf_field() ?>

            <div class="row">
                <label>City Name</label>
                <input type="text" name="city_name" value="<?= old('city_name') ?>" placeholder="e.g. Isulan">
            </div>

            <div class="row">
                <label>Country Code (optional)</label>
                <input type="text" name="country" value="<?= old('country') ?>" maxlength="2" placeholder="e.g. PH">
                <div class="hint">Tip: Use ISO2 like PH/US/JP. Leaving blank still works.</div>
            </div>

            <div class="actions">
                <button type="submit" class="btn">Save</button>
                <a href="<?= base_url('weather'); ?>" class="btn">Back</a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
