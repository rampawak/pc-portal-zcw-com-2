<?php
/**
 * LinkCard - renders a structured HTML card with link preview.
 * No external dependencies.
 */

/**
 * Render an HTML link card with escaped output.
 *
 * @param array $data Associative array with keys: url, title, description, image
 * @return string Safe HTML string
 */
function renderLinkCard(array $data): string
{
    $url = $data['url'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $image = $data['image'] ?? '';

    $escapedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $escapedTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $escapedDescription = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    $escapedImage = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');

    $html = '<div class="link-card">';
    $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';

    if ($escapedImage !== '') {
        $html .= '<div class="link-card-image">';
        $html .= '<img src="' . $escapedImage . '" alt="' . $escapedTitle . '" loading="lazy" />';
        $html .= '</div>';
    }

    $html .= '<div class="link-card-body">';
    $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
    $html .= '<p class="link-card-description">' . $escapedDescription . '</p>';
    $html .= '<span class="link-card-url">' . $escapedUrl . '</span>';
    $html .= '</div>';

    $html .= '</a>';
    $html .= '</div>';

    return $html;
}

/**
 * Render a list of link cards.
 *
 * @param array $cards Array of associative arrays
 * @return string Concatenated HTML
 */
function renderLinkCardList(array $cards): string
{
    $output = '<div class="link-card-list">';
    foreach ($cards as $card) {
        $output .= renderLinkCard($card);
    }
    $output .= '</div>';
    return $output;
}

// --- Sample usage (not executed when included) ---

$sampleCards = [
    [
        'url' => 'https://pc-portal-zcw.com',
        'title' => '足彩网 - 首页',
        'description' => '足彩网提供全面的体育赛事资讯和实时比分数据。',
        'image' => '',
    ],
    [
        'url' => 'https://pc-portal-zcw.com/football',
        'title' => '足彩网 - 足球',
        'description' => '深度足球赛事分析，赔率变化一手掌握。',
        'image' => 'https://pc-portal-zcw.com/images/football.jpg',
    ],
];

// If called directly, output sample HTML
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html lang="zh-CN"><head><meta charset="UTF-8"><title>LinkCard Demo</title>';
    echo '<style>
        .link-card { border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; margin: 16px 0; max-width: 400px; }
        .link-card a { text-decoration: none; color: inherit; display: block; }
        .link-card-image img { width: 100%; height: auto; display: block; }
        .link-card-body { padding: 12px; }
        .link-card-title { margin: 0 0 8px; font-size: 18px; }
        .link-card-description { margin: 0 0 8px; color: #555; font-size: 14px; }
        .link-card-url { color: #1a73e8; font-size: 12px; word-break: break-all; }
        .link-card-list { display: flex; flex-wrap: wrap; gap: 16px; }
    </style></head><body>';
    echo renderLinkCardList($sampleCards);
    echo '</body></html>';
}