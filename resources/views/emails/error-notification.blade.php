<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>System Error Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #dc3545;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 0 0 5px 5px;
        }
        .error-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 15px;
            margin: 15px 0;
        }
        .timestamp {
            color: #6c757d;
            font-size: 0.9em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>🚨 System Error Notification</h2>
        <p><strong>Context:</strong> {{ $context }}</p>
    </div>
    
    <div class="content">
        <p>A system error has occurred that requires attention:</p>
        
        <div class="error-box">
            <strong>Error Message:</strong><br>
            {{ $errorMessage }}
        </div>
        
        <p>Please investigate this issue as soon as possible.</p>
        
        <div class="timestamp">
            <strong>Timestamp:</strong> {{ $timestamp }}
        </div>
    </div>
</body>
</html>