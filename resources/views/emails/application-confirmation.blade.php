<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .header {
            background-color: #C0F037;
            color: #000;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .info-box {
            background-color: #fff;
            border-left: 4px solid #C0F037;
            padding: 15px;
            margin: 15px 0;
        }

        .btn {
            display: inline-block;
            background-color: #C0F037;
            color: #000;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Đơn Ứng Tuyển Được Gửi</h1>
        </div>

        <div class="content">
            <p>Xin chào <strong>{{ $name }}</strong>,</p>

            <p>Cảm ơn bạn đã gửi đơn ứng tuyển cho vị trí <strong>{{ $position }}</strong> tại Công ty SCF.</p>

            <div class="info-box">
                <h3>Thông tin đơn ứng tuyển của bạn</h3>
                <p><strong>Mã đơn:</strong> #{{ $applicationId }}</p>
                <p><strong>Vị trí:</strong> {{ $position }}</p>
                <p><strong>Ngày gửi:</strong> {{ now()->format('d/m/Y H:i') }}</p>
            </div>

            <p>Chúng tôi đã nhận được đơn ứng tuyển của bạn. Đội ngũ nhân sự sẽ xem xét hồ sơ của bạn trong thời gian
                sớm nhất.</p>

            <p>Nếu hồ sơ của bạn phù hợp với yêu cầu của vị trí, chúng tôi sẽ liên hệ với bạn để thảo luận về các bước
                tiếp theo.</p>

            <div class="info-box">
                <p><strong>Lưu ý:</strong></p>
                <ul>
                    <li>Vui lòng kiểm tra email spam/promotions nếu bạn không thấy email từ chúng tôi</li>
                    <li>Đảm bảo rằng thông tin liên lạc của bạn là chính xác</li>
                    <li>Chúng tôi sẽ liên hệ bằng email hoặc điện thoại được cung cấp</li>
                </ul>
            </div>

            <p>Chúc bạn may mắn!</p>

            <p>
                Trân trọng,<br>
                <strong>Đội Tuyển Dụng - SCF</strong>
            </p>
        </div>

        <div class="footer">
            <p>&copy; 2024 Công Ty TNHH SCF. Tất cả các quyền được bảo lưu.</p>
            <p>Địa chỉ: 421 Allen, Mexico 4233</p>
            <p>Email: <a href="mailto:info@scf.com">info@scf.com</a></p>
        </div>
    </div>
</body>

</html>
