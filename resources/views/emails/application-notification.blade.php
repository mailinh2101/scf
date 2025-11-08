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
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        table td:first-child {
            font-weight: bold;
            width: 150px;
            background-color: #f0f0f0;
        }

        .btn {
            display: inline-block;
            background-color: #C0F037;
            color: #000;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📋 Đơn Ứng Tuyển Mới</h1>
        </div>

        <div class="content">
            <p>Chào bạn,</p>

            <p>Có một đơn ứng tuyển mới cho vị trí <strong>{{ $position }}</strong></p>

            <div class="info-box">
                <h3>Thông Tin Ứng Viên</h3>
                <table>
                    <tr>
                        <td>Mã Đơn:</td>
                        <td>#{{ $applicationId }}</td>
                    </tr>
                    <tr>
                        <td>Họ và Tên:</td>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><a href="mailto:{{ $email }}">{{ $email }}</a></td>
                    </tr>
                    <tr>
                        <td>Số Điện Thoại:</td>
                        <td>{{ $phone ?? 'Chưa cung cấp' }}</td>
                    </tr>
                    <tr>
                        <td>Vị Trí:</td>
                        <td>{{ $position }}</td>
                    </tr>
                    <tr>
                        <td>Ngày Gửi:</td>
                        <td>{{ now()->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>

            @if ($message)
                <div class="info-box">
                    <h3>Thư Xin Việc</h3>
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($cvPath)
                <div class="info-box">
                    <h3>Tài Liệu Đính Kèm</h3>
                    <p>✓ CV: <strong>{{ basename($cvPath) }}</strong></p>
                    <p><em>Đường dẫn: {{ $cvPath }}</em></p>
                </div>
            @endif

            <div class="info-box">
                <h3>Thao Tác Tiếp Theo</h3>
                <p>Vui lòng xem xét hồ sơ ứng viên và thực hiện các bước tiếp theo:</p>
                <ul>
                    <li>Xem xét thông tin chi tiết</li>
                    <li>Liên hệ với ứng viên nếu phù hợp</li>
                    <li>Cập nhật trạng thái đơn ứng tuyển</li>
                </ul>
            </div>

            <p>
                Trân trọng,<br>
                <strong>Hệ Thống Quản Lý Tuyển Dụng - SCF</strong>
            </p>
        </div>

        <div class="footer">
            <p>&copy; 2024 Công Ty TNHH SCF. Tất cả các quyền được bảo lưu.</p>
            <p>Đây là email tự động, vui lòng không trả lời.</p>
        </div>
    </div>
</body>

</html>
