<?php
// دریافت داده از فرم
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['data'])) {
    header('Location: index.php');
    exit;
}

$data = $_POST['data'];
$size = isset($_POST['size']) ? intval($_POST['size']) : 300;

// محدود کردن اندازه به مقادیر مجاز
if ($size < 100) $size = 100;
if ($size > 1000) $size = 1000;

// استفاده از API رایگان برای تولید QR Code
$qr_url = 'https://api.qrserver.com/v1/create-qr-code/?data=' . 
          urlencode($data) . 
          '&size=' . $size . 'x' . $size . 
          '&margin=10';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code تولید شده</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Tahoma', 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .qr-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .qr-container img {
            max-width: 100%;
            height: auto;
            display: block;
        }
        
        .data-display {
            background: #f1f3f5;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            word-break: break-all;
            color: #555;
            font-size: 14px;
            text-align: left;
            direction: ltr;
            max-height: 100px;
            overflow-y: auto;
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .btn-back {
            background: #6c757d;
        }
        
        .btn-download {
            background: #28a745;
        }
        
        .btn-new {
            background: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> QR Code تولید شد!</h1>
        
        <div class="qr-container">
            <img src="<?php echo htmlspecialchars($qr_url); ?>" 
                 alt="QR Code" 
                 width="<?php echo $size; ?>" 
                 height="<?php echo $size; ?>">
        </div>
        
        <div class="data-display">
            <?php echo htmlspecialchars($data); ?>
        </div>
        
        <div class="btn-group">
            <a href="<?php echo htmlspecialchars($qr_url); ?>" 
               download="qrcode.png" 
               class="btn btn-download">
                 دانلود
            </a>
            <a href="index.php" class="btn btn-back">
                 QR جدید
            </a>
        </div>
    </div>
</body>
</html>
