<?php

if (!function_exists('safe_count')) {
    function safe_count($query): int {
        try { return (int) $query->count(); } catch (\Exception $e) { return 0; }
    }
}

if (!function_exists('safe_sum')) {
    function safe_sum($query, string $col): float {
        try { return (float) $query->sum($col); } catch (\Exception $e) { return 0; }
    }
}

if (!function_exists('safe_get')) {
    function safe_get($query, int $limit = 5) {
        try { return $query->take($limit)->get(); } catch (\Exception $e) { return collect(); }
    }
}

if (!function_exists('growth_rate')) {
    function growth_rate($previous, $current): float {
        if ($previous > 0) return round((($current - $previous) / $previous) * 100, 1);
        return $current > 0 ? 100 : 0;
    }
}
