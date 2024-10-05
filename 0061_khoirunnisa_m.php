<?php


// post form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // form
    $total_belanja_0061 = $_POST['total_belanja'];
    $member_0061 = $_POST['member'];

    // diskon
    function hitungDiskon_0061($total_belanja_0061, $member_0061) {
        $diskon_0061 = 0;
        $diskon_member_0061 = 0.10 * $total_belanja_0061;

        if ($member_0061) {
            // Jika member
            $diskon_member_0061 = 0.10 * $total_belanja_0061;
            if ($total_belanja_0061 > 1000000) {
                $diskon_0061 = 0.15 * ($total_belanja_0061-$diskon_member_0061);
            } elseif ($total_belanja_0061 >= 500000) {
                $diskon_0061 = 0.10 * ($total_belanja_0061-$diskon_member_0061);
            } 
        } else {
            // Jika bukan member
            $diskon_member_0061 = 0;
            if ($total_belanja_0061 > 1000000) {
                $diskon_0061 = 0.10 * $total_belanja_0061;
            } elseif ($total_belanja_0061 >= 500000) {
                $diskon_0061 = 0.05 * $total_belanja_0061;
            }
        }

        // Total bayar setelah diskon
        $total_bayar_0061 = $total_belanja_0061 -$diskon_member_0061- $diskon_0061;
        return array('total_belanja_0061' => $total_belanja_0061, 'diskon_member_0061' => $diskon_member_0061,
        'diskon_0061' => $diskon_0061 , 'pot&diskon_0061'=> $diskon_member_0061+$diskon_0061, 'total_bayar_0061' => $total_bayar_0061);
    }

    //menghitung diskon
    $result_0061 = hitungDiskon_0061($total_belanja_0061, $member_0061);

    $_SESSION['result_0061'] = $result_0061;
    $_SESSION['result_time_0061'] = time();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to bottom right, #74ebd5, #acb6e5);
        }
        .container {
            width: 550px;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .container:hover {
            transform: scale(1.03);
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
            position: relative;
        }
        h1:before {
            content: '';
            position: absolute;
            width: 50px;
            height: 4px;
            background-color: #74ebd5;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 20px 0 10px;
            color: #666;
            font-size: 1rem;
        }
        input[type="text"], select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            margin-bottom: 15px;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus, select:focus {
            border-color: #74ebd5;
            outline: none;
        }
        input[type="submit"] {
            padding: 12px;
            background-color: #74ebd5;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #5ac8d5;
        }
        .result {
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 1.1rem;
            color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .result p {
            margin: 5px 0;
            font-size: 1.05rem;
        }
    </style>
    <script>
   
        setTimeout(function() {
            var resultDiv_0061 = document.querySelector('.result');
            if (resultDiv_0061) {
                resultDiv_0061.style.display = 'none';
            }
        }, 30000); 
    </script>
</head>
<body>

<div class="container">
    <h1>Hitung Total Bayar</h1>
    <form method="POST">
        <label for="total_belanja">Total Belanja (Rp):</label>
        <input type="text" id="total_belanja" name="total_belanja" required>

        <label for="member">Apakah Anda Member?</label>
        <select id="member" name="member">
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </select>

        <input type="submit" value="Total Bayar">
    </form>

    <?php
    // Tampilkan hasil 
    if (isset($_SESSION['result_0061'])) {
        echo "<div class='result'>";
        echo "<p>Total Belanja: Rp " . number_format($_SESSION['result_0061']['total_belanja_0061'], 0, ',', '.') . "</p>";
        echo "<p>Potongan Member: Rp " . number_format($_SESSION['result_0061']['diskon_member_0061'], 0, ',', '.') . "</p>";
        echo "<p>Diskon: Rp " . number_format($_SESSION['result_0061']['diskon_0061'], 0, ',', '.') . "</p>";
        echo "<p>Total Potongan & Diskon: Rp " . number_format($_SESSION['result_0061']['pot&diskon_0061'], 0, ',', '.') . "</p>";
        echo "<p>Total Bayar: Rp " . number_format($_SESSION['result_0061']['total_bayar_0061'], 0, ',', '.') . "</p>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
