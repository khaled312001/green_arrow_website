<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a setting value by key
     */
    function setting($key, $default = null) {
        return Setting::get($key, $default);
    }
}

if (!function_exists('get_social_links')) {
    /**
     * Get all social media links
     */
    function get_social_links() {
        return [
            'facebook' => [
                'url' => setting('facebook_url'),
                'icon' => 'bi-facebook',
                'color' => 'text-primary',
                'label' => 'فيسبوك'
            ],
            'twitter' => [
                'url' => setting('twitter_url'),
                'icon' => 'bi-twitter-x',
                'color' => 'text-dark',
                'label' => 'تويتر'
            ],
            'instagram' => [
                'url' => setting('instagram_url'),
                'icon' => 'bi-instagram',
                'color' => 'text-danger',
                'label' => 'انستغرام'
            ],
            'youtube' => [
                'url' => setting('youtube_url'),
                'icon' => 'bi-youtube',
                'color' => 'text-danger',
                'label' => 'يوتيوب'
            ],
            'linkedin' => [
                'url' => setting('linkedin_url'),
                'icon' => 'bi-linkedin',
                'color' => 'text-primary',
                'label' => 'لينكد إن'
            ],
            'tiktok' => [
                'url' => setting('tiktok_url'),
                'icon' => 'bi-tiktok',
                'color' => 'text-dark',
                'label' => 'تيك توك'
            ],
            'telegram' => [
                'url' => setting('telegram_url'),
                'icon' => 'bi-telegram',
                'color' => 'text-primary',
                'label' => 'تليجرام'
            ],
            'snapchat' => [
                'url' => setting('snapchat_url'),
                'icon' => 'bi-snapchat',
                'color' => 'text-warning',
                'label' => 'سناب شات'
            ],
            'google_maps' => [
                'url' => setting('google_maps_url'),
                'icon' => 'bi-geo-alt',
                'color' => 'text-success',
                'label' => 'الموقع على الخريطة'
            ],
            'whatsapp' => [
                'url' => 'https://wa.me/' . str_replace(['+', ' ', '-'], '', setting('site_whatsapp')),
                'icon' => 'bi-whatsapp',
                'color' => 'text-success',
                'label' => 'واتساب'
            ],
            'email' => [
                'url' => 'mailto:' . setting('site_email'),
                'icon' => 'bi-envelope',
                'color' => 'text-info',
                'label' => 'البريد الإلكتروني'
            ],
            'phone' => [
                'url' => 'tel:' . setting('site_phone'),
                'icon' => 'bi-telephone',
                'color' => 'text-success',
                'label' => 'الهاتف'
            ],
            'discord' => [
                'url' => setting('discord_url'),
                'icon' => 'bi-discord',
                'color' => 'text-primary',
                'label' => 'ديسكورد'
            ],
            'twitch' => [
                'url' => setting('twitch_url'),
                'icon' => 'bi-twitch',
                'color' => 'text-danger',
                'label' => 'تويتش'
            ],
            'pinterest' => [
                'url' => setting('pinterest_url'),
                'icon' => 'bi-pinterest',
                'color' => 'text-danger',
                'label' => 'بينتريست'
            ],
            'reddit' => [
                'url' => setting('reddit_url'),
                'icon' => 'bi-reddit',
                'color' => 'text-warning',
                'label' => 'ريديت'
            ],
            'github' => [
                'url' => setting('github_url'),
                'icon' => 'bi-github',
                'color' => 'text-dark',
                'label' => 'جيت هب'
            ],
            'medium' => [
                'url' => setting('medium_url'),
                'icon' => 'bi-medium',
                'color' => 'text-dark',
                'label' => 'ميديوم'
            ],
            'behance' => [
                'url' => setting('behance_url'),
                'icon' => 'bi-behance',
                'color' => 'text-primary',
                'label' => 'بيهانس'
            ],
            'dribbble' => [
                'url' => setting('dribbble_url'),
                'icon' => 'bi-dribbble',
                'color' => 'text-danger',
                'label' => 'دريببل'
            ],
            'spotify' => [
                'url' => setting('spotify_url'),
                'icon' => 'bi-spotify',
                'color' => 'text-success',
                'label' => 'سبوتيفاي'
            ],
            'apple_music' => [
                'url' => setting('apple_music_url'),
                'icon' => 'bi-apple',
                'color' => 'text-dark',
                'label' => 'آبل ميوزك'
            ],
            'soundcloud' => [
                'url' => setting('soundcloud_url'),
                'icon' => 'bi-soundcloud',
                'color' => 'text-warning',
                'label' => 'ساوند كلاود'
            ],
            'vimeo' => [
                'url' => setting('vimeo_url'),
                'icon' => 'bi-vimeo',
                'color' => 'text-primary',
                'label' => 'فيمييو'
            ],
            'flickr' => [
                'url' => setting('flickr_url'),
                'icon' => 'bi-flickr',
                'color' => 'text-danger',
                'label' => 'فليكر'
            ],
            'quora' => [
                'url' => setting('quora_url'),
                'icon' => 'bi-quora',
                'color' => 'text-danger',
                'label' => 'كورا'
            ],
            'stack_overflow' => [
                'url' => setting('stack_overflow_url'),
                'icon' => 'bi-stack-overflow',
                'color' => 'text-warning',
                'label' => 'ستاك أوفرفلو'
            ],
            'wordpress' => [
                'url' => setting('wordpress_url'),
                'icon' => 'bi-wordpress',
                'color' => 'text-primary',
                'label' => 'ووردبريس'
            ],
            'blogger' => [
                'url' => setting('blogger_url'),
                'icon' => 'bi-blogger',
                'color' => 'text-warning',
                'label' => 'بلوجر'
            ],
            'tumblr' => [
                'url' => setting('tumblr_url'),
                'icon' => 'bi-tumblr',
                'color' => 'text-dark',
                'label' => 'تمبلر'
            ],
            'xing' => [
                'url' => setting('xing_url'),
                'icon' => 'bi-xing',
                'color' => 'text-success',
                'label' => 'زينج'
            ],
            'skype' => [
                'url' => 'skype:' . setting('skype_username'),
                'icon' => 'bi-skype',
                'color' => 'text-primary',
                'label' => 'سكايب'
            ],
            'wechat' => [
                'url' => setting('wechat_url'),
                'icon' => 'bi-wechat',
                'color' => 'text-success',
                'label' => 'وي تشات'
            ],
            'line' => [
                'url' => setting('line_url'),
                'icon' => 'bi-line',
                'color' => 'text-success',
                'label' => 'لاين'
            ],
            'kakao' => [
                'url' => setting('kakao_url'),
                'icon' => 'bi-kakao',
                'color' => 'text-warning',
                'label' => 'كاكاو'
            ],
            'naver' => [
                'url' => setting('naver_url'),
                'icon' => 'bi-naver',
                'color' => 'text-success',
                'label' => 'نافير'
            ],
            'baidu' => [
                'url' => setting('baidu_url'),
                'icon' => 'bi-baidu',
                'color' => 'text-primary',
                'label' => 'بايدو'
            ],
            'qq' => [
                'url' => setting('qq_url'),
                'icon' => 'bi-qq',
                'color' => 'text-primary',
                'label' => 'كيو كيو'
            ],
            'weibo' => [
                'url' => setting('weibo_url'),
                'icon' => 'bi-weibo',
                'color' => 'text-danger',
                'label' => 'ويبو'
            ]
        ];
    }
}

if (!function_exists('get_active_social_links')) {
    /**
     * Get only active social media links (with URLs)
     */
    function get_active_social_links() {
        $allLinks = get_social_links();
        $activeLinks = [];
        
        foreach ($allLinks as $platform => $link) {
            if (!empty($link['url'])) {
                $activeLinks[$platform] = $link;
            }
        }
        
        return $activeLinks;
    }
}

if (!function_exists('render_social_icons')) {
    /**
     * Render social media icons HTML
     */
    function render_social_icons($size = 'fs-5', $showLabels = false, $containerClass = 'd-flex gap-2') {
        $activeLinks = get_active_social_links();
        
        if (empty($activeLinks)) {
            return '';
        }
        
        $html = '<div class="' . $containerClass . '">';
        
        foreach ($activeLinks as $platform => $link) {
            $html .= '<a href="' . $link['url'] . '" target="_blank" rel="noopener noreferrer" ';
            $html .= 'class="text-decoration-none ' . $link['color'] . ' ' . $size . '" ';
            $html .= 'title="' . $link['label'] . '" aria-label="' . $link['label'] . '">';
            $html .= '<i class="bi ' . $link['icon'] . '"></i>';
            if ($showLabels) {
                $html .= '<span class="ms-1">' . $link['label'] . '</span>';
            }
            $html .= '</a>';
        }
        
        $html .= '</div>';
        
        return $html;
    }
} 