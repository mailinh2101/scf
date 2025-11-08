<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AssetHelper
{
    /**
     * Chuyển đổi đường dẫn file sang URL công khai
     *
     * @param string|null $path Đường dẫn file (vd: 'products/image.jpg' hoặc 'posts/filename.jpg')
     * @return string|null URL công khai hoặc null nếu không có path
     */
    public static function assetUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        // Nếu đã là URL đầy đủ, trả về như cũ
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // Nếu đường dẫn không bắt đầu bằng 'storage/', thêm nó vào
        if (!Str::startsWith($path, 'storage/')) {
            $path = 'storage/' . ltrim($path, '/');
        }

        // Trả về URL công khai đầy đủ
        return asset($path);
    }

    /**
     * Lấy đường dẫn đầy đủ tới file lưu trữ
     *
     * @param string|null $path Đường dẫn file
     * @return string|null Đường dẫn đầy đủ hoặc null
     */
    public static function storagePath(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        // Nếu đã có 'storage/' ở đầu, chuyển thành 'app/public/'
        if (Str::startsWith($path, 'storage/')) {
            $path = Str::replaceFirst('storage/', '', $path);
        }

        return storage_path('app/public/' . ltrim($path, '/'));
    }
}
