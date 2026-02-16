<?php
/**
 * Blog Static - Entry Point
 * 
 * A simple flat-file blog with public/private structure.
 */

declare(strict_types=1);

// Load configuration and posts
$postsDir = __DIR__ . '/../data/posts';
$posts = [];

if (is_dir($postsDir)) {
    $files = glob($postsDir . '/*.md');
    rsort($files); // Sort by filename (date)
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        if ($content === false) {
            continue;
        }
        
        // Extract title from first heading
        $title = 'Untitled';
        if (preg_match('/^#\s+(.+)$/m', $content, $matches)) {
            $title = trim($matches[1]);
        }
        
        // Extract excerpt (first paragraph after title)
        $excerpt = '';
        if (preg_match('/^#\s+.+\n\n(.+?)(?:\n\n|\n#|$)/s', $content, $matches)) {
            $excerpt = trim($matches[1]);
            // Strip markdown for plain text excerpt
            $excerpt = preg_replace('/[\*\_\`]/', '', $excerpt);
        }
        
        $posts[] = [
            'slug' => basename($file, '.md'),
            'title' => $title,
            'excerpt' => $excerpt,
            'date' => date('F j, Y', strtotime(substr(basename($file, '.md'), 0, 10))),
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Static Blog</title>
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
        <section class="intro">
            <h2>Welcome!</h2>
            <p>This is a simple static blog powered by Lutin.php. 
               Posts are stored as Markdown files in the data directory.</p>
        </section>

        <section class="posts">
            <h2>Recent Posts</h2>
            
            <?php if (empty($posts)): ?>
                <article class="post">
                    <h3>No posts yet</h3>
                    <p>Create your first post by adding a Markdown file to <code>data/posts/</code></p>
                </article>
            <?php else: ?>
                <?php foreach (array_slice($posts, 0, 5) as $post): ?>
                    <article class="post">
                        <header>
                            <h3><a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a></h3>
                            <time datetime="<?php echo htmlspecialchars($post['slug']); ?>">
                                <?php echo htmlspecialchars($post['date']); ?>
                            </time>
                        </header>
                        <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                        <a href="post.php?slug=<?php echo htmlspecialchars($post['slug']); ?>" 
                           class="read-more">Read more →</a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> My Static Blog. Built with Lutin.php</p>
        </div>
    </footer>
</body>
</html>
