<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Pernikahan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right,rgb(239, 146, 196),rgba(254, 4, 4, 0.57));
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 600px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            background: #ff4e50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #d63e3f;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .guestbook {
            margin-top: 40px;
        }

        .message {
            background: #f0f0f0;
            border-left: 5px solid #ff4e50;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .message h4 {
            margin: 0;
            color: #333;
        }

        .message p {
            margin: 5px 0 0;
        }

        .message small {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buku Tamu Pernikahan</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $conn->real_escape_string($_POST['name']);
            $message = $conn->real_escape_string($_POST['message']);

            if ($name && $message) {
                $conn->query("INSERT INTO guestbook (guest_name, message) VALUES ('$name', '$message')");
                echo '<div class="success">💖 Terima kasih atas ucapanmu, ' . htmlspecialchars($name) . '!</div>';
            }
        }
        ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Nama Anda" required>
            <textarea name="message" rows="4" placeholder="Ucapan untuk pengantin" required></textarea>
            <button type="submit">Kirim Ucapan</button>
        </form>

        <div class="guestbook">
            <h2>Ucapan Tamu</h2>
            <?php
            $result = $conn->query("SELECT * FROM guestbook ORDER BY created_at DESC");
            while ($row = $result->fetch_assoc()) {
                echo "<div class='message'>";
                echo "<h4>" . htmlspecialchars($row['guest_name']) . "</h4>";
                echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                echo "<small>" . date("d M Y H:i", strtotime($row['created_at'])) . "</small>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
