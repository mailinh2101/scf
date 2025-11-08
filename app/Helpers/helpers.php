<?php

/**
 * Asset URL Helper Functions
 */

use App\Helpers\AssetHelper;

if (!function_exists('asset_url')) {
    /**
     * Get full URL for asset from storage
     *
     * @param string|null $path
     * @return string|null
     */
    function asset_url(?string $path): ?string
    {
        return AssetHelper::assetUrl($path);
    }
}

if (!function_exists('storage_full_path')) {
    /**
     * Get full storage path for file
     *
     * @param string|null $path
     * @return string|null
     */
    function storage_full_path(?string $path): ?string
    {
        return AssetHelper::storagePath($path);
    }
}
