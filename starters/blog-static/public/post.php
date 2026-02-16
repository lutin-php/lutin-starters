<?php
/**
 * Blog Static - Single Post View
 */

declare(strict_types=1);

$slug = $_GET['slug'] ?? '';

// Validate slug (prevent directory traversal)
if (!preg_match('/^[\w\-]+$/', $slug)) {
    http_response_code(400);
    die('Invalid post slug');
}

$postFile = __DIR__ . '/../data/posts/' . $slug . '.md';

if (!file_exists($postFile)) {
    http_response_code(404);
    die('Post not found');
}

$content = file_get_contents($postFile);
if ($content === false) {
    http_response_code(500);
    die('Failed to read post');
}

// Parse markdown content
$title = 'Untitled';
if (preg_match('/^#\s+(.+)$/m', $content, $matches)) {
    $title = trim($matches[1]);
}

// Extract date from slug (YYYY-MM-DD-format)
$date = '';
if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $slug, $matches)) {
    $date = date('F j, Y', strtotime($matches[1]));
}

// Simple markdown to HTML conversion
$body = $content;
// Remove title from body (already shown as h1)
$body = preg_replace('/^#\s+.+\n+/', '', $body);
// Convert headers
$body = preg_replace('/^##\s+(.+)$/m', '<h2>$1</h2>', $body);
$body = preg_replace('/^###\s+(.+)$/m', '<h3>$1</h3>', $body);
// Convert bold and italic
$body = preg_replace('/\*\*\*(.+?)\*\*\*/', '<strong><em>$1</em></strong>', $body);
$body = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $body);
$body = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $body);
// Convert code blocks
$body = preg_replace('/```([\s\S]*?)```/', '<pre><code>$1</code></pre>', $body);
$body = preg_replace('/`(.+?)`/', '<code>$1</code>', $body);
// Convert lists
$body = preg_replace('/^\*\s+(.+)$/m', '<li>$1</li>', $body);
$body = preg_replace('/(<li>.*<\/li>\n?)+/', '<ul>$0</ul>', $body);
$body = str_replace('</ul><ul>', '', $body);
// Convert paragraphs (lines followed by blank line)
$body = preg_replace('/\n\n/', '</p><p>', $body);
// Wrap in paragraph if not already wrapped
if (!str_starts_with(trim($body), '<')) {
    $body = '<p>' . $body . '</p>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - My Static Blog</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📝 My Static Blog</h1>
            <nav>
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <article class="post-content">
            <h1><?php echo htmlspecialchars($title); ?></h1>
            <?php if ($date): ?>
                <time datetime="<?php echo htmlspecialchars($slug); ?>">
                    <?php echo htmlspecialchars($date); ?>
                </time>
            <?php endif; ?>
            
            <?php echo $body; ?>
            
            <a href="index.php" class="back-link">← Back to all posts</a>
        </article>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> My Static Blog. Built with Lutin.php</p>
        </div>
    </footer>
</body>
</html>
