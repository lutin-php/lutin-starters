<?php
/**
 * Blog Static - About Page
 */

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - My Static Blog</title>
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
            <h1>About This Blog</h1>
            
            <p>This is a minimal static blog built with <strong>Lutin.php</strong>. 
               It's designed to be simple, fast, and easy to maintain.</p>
            
            <h2>Features</h2>
            <ul>
                <li>Flat-file architecture - no database needed</li>
                <li>Markdown support for writing posts</li>
                <li>Clean, responsive design</li>
                <li>Fast page loads</li>
                <li>Easy to customize</li>
            </ul>
            
            <h2>How to Add Posts</h2>
            <p>To create a new blog post, simply add a Markdown file to the 
               <code>data/posts/</code> directory. Name your file using the format:</p>
            
            <pre><code>YYYY-MM-DD-post-slug.md</code></pre>
            
            <p>For example:</p>
            <pre><code>2026-02-16-hello-world.md</code></pre>
            
            <p>Each post should start with a heading:</p>
            <pre><code># My Post Title

This is the first paragraph of my post...</code></pre>
            
            <a href="index.php" class="back-link">← Back to home</a>
        </article>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> My Static Blog. Built with Lutin.php</p>
        </div>
    </footer>
</body>
</html>
