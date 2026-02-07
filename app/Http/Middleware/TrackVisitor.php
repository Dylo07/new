<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests for HTML pages (skip assets, AJAX, API)
        if (
            $request->method() !== 'GET' ||
            $request->ajax() ||
            $request->wantsJson() ||
            $request->is('admin/*') ||
            str_contains($request->path(), '.')
        ) {
            return $response;
        }

        // Throttle: max 1 log per IP per page per 5 minutes
        $ip = $request->ip();
        $url = $request->path();

        $recentVisit = Visitor::where('ip_address', $ip)
            ->where('url', $url)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if ($recentVisit) {
            return $response;
        }

        // Detect device type
        $userAgent = $request->userAgent() ?? '';
        $deviceType = 'desktop';
        if (preg_match('/Mobile|Android|iPhone/i', $userAgent)) {
            $deviceType = 'mobile';
        } elseif (preg_match('/iPad|Tablet/i', $userAgent)) {
            $deviceType = 'tablet';
        }

        // Detect browser
        $browser = 'Other';
        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edge|OPR/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Edge/i', $userAgent)) {
            $browser = 'Edge';
        } elseif (preg_match('/OPR|Opera/i', $userAgent)) {
            $browser = 'Opera';
        }

        // Detect platform
        $platform = 'Other';
        if (preg_match('/Windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/Macintosh|Mac OS/i', $userAgent)) {
            $platform = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent) && !preg_match('/Android/i', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
            $platform = 'iOS';
        }

        // Friendly page name
        $pageName = $this->getPageName($url);

        // Geo lookup via free ip-api.com (non-commercial, no key needed)
        $country = null;
        $countryCode = null;
        $city = null;

        try {
            $geo = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,country,countryCode,city", false, stream_context_create([
                'http' => ['timeout' => 2]
            ]));
            if ($geo) {
                $data = json_decode($geo, true);
                if (isset($data['status']) && $data['status'] === 'success') {
                    $country = $data['country'] ?? null;
                    $countryCode = $data['countryCode'] ?? null;
                    $city = $data['city'] ?? null;
                }
            }
        } catch (\Exception $e) {
            // Silently fail — geo is optional
        }

        Visitor::create([
            'ip_address'   => $ip,
            'country'      => $country,
            'country_code' => $countryCode,
            'city'         => $city,
            'url'          => $url,
            'page_name'    => $pageName,
            'device_type'  => $deviceType,
            'browser'      => $browser,
            'platform'     => $platform,
            'referrer'     => $request->header('Referer'),
            'user_id'      => auth()->check() ? auth()->id() : null,
        ]);

        return $response;
    }

    private function getPageName(string $url): string
    {
        $url = trim($url, '/');

        if ($url === '' || $url === '/') return 'Home';

        $map = [
            'about'            => 'About Us',
            'contact'          => 'Contact',
            'packages'         => 'Packages',
            'package-builder'  => 'Package Builder',
            'gallery'          => 'Gallery',
            'menu'             => 'Menu',
            'rooms'            => 'Rooms',
            'login'            => 'Login',
            'register'         => 'Register',
        ];

        foreach ($map as $key => $name) {
            if (str_starts_with($url, $key)) {
                return $name;
            }
        }

        return ucwords(str_replace(['-', '/'], [' ', ' › '], $url));
    }
}
