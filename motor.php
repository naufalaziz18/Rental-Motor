<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 50px;
            background-color: #f4f4f4;
            text-align: center; /* Tambahkan ini */
        }

        .output {
            margin-top: 20px;
            padding: 10px;
            background-color: #e0e0e0;
            display: inline-block; /* Tambahkan ini */
            text-align: left; /* Tambahkan ini */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rental Motor</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nama-pelanggan">Nama Pelanggan:</label>
            <input type="text" id="nama-pelanggan" name="nama_pelanggan" required>
            <label for="lama-rental">Lama Waktu Rental (per hari):</label>
            <br>
            <input type="number" id="lama-rental" name="lama_rental" min="1" required>
            <label for="jenis-motor">Jenis Motor:</label>
            <select id="jenis-motor" name="jenis_motor" required>
                <option value="scooter">Scooter</option>
                <option value="Yamaha">Yamaha</option>
                <option value="Honda">Honda</option>
                <option value="Suzuki">Suzuki</option>
                <!-- Add other motor types here -->
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
        <?php
        class MotorRental {
            private $nama_pelanggan;
            private $lama_rental;
            private $jenis_motor;
            private $diskon;
            private $harga_per_hari;
            private $pajak;

            public function __construct($nama_pelanggan, $lama_rental, $jenis_motor) {
                $this->nama_pelanggan = $nama_pelanggan;
                $this->lama_rental = $lama_rental;
                $this->jenis_motor = $jenis_motor;
                $this->diskon = 0;
                $this->harga_per_hari = 70000;
                $this->pajak = 10000;

                if ($nama_pelanggan == 'ana') {
                    $this->diskon = 0.05;
                }
            }

            public function calculateTotal() {
                $total = ($this->lama_rental * $this->harga_per_hari) - (($this->lama_rental * $this->harga_per_hari) * $this->diskon);
                return $total + $this->pajak;
            }

            public function displayOutput() {
                echo "<div class='output'>";
                echo "<h2>Rental Motor</h2>";
                echo "<p>Nama Pelanggan: {$this->nama_pelanggan}</p>";
                echo "<p>Lama Waktu Rental (per hari): {$this->lama_rental}</p>";
                echo "<p>Jenis Motor: {$this->jenis_motor}</p>";
                echo "<p>Total: Rp. " . number_format($this->calculateTotal(), 2) . "</p>";
                echo "</div>";
            }
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $motor_rental = new MotorRental($_POST['nama_pelanggan'], $_POST['lama_rental'], $_POST['jenis_motor']);
            $motor_rental->displayOutput();
        }
        ?>
    </div>
</body>
</html>