# Minimal Static Blog Starter

A simple flat-file blog with a public/private structure designed for the Lutin.php ecosystem.

## Architecture Overview

This starter follows the **Public/Private Split** pattern:

```
starters/blog-static/
├── public/              # Web-accessible files
│   ├── index.php        # Blog homepage (lists posts)
│   ├── post.php         # Single post view
│   ├── about.php        # About page
│   └── assets/
│       └── style.css    # Main stylesheet
├── src/                 # Private logic (if needed)
├── data/
│   └── posts/           # Markdown blog posts
└── lutin/
    └── AGENTS.md        # This file
```

## Key File Locations

### Styles
- **Main CSS:** `public/assets/style.css`
- Uses CSS custom properties (variables) for easy theming
- Colors defined in `:root` - modify these to change the entire color scheme

### Content
- **Blog posts:** `data/posts/YYYY-MM-DD-slug.md`
- Markdown format with front-matter style title (first H1)
- Posts automatically sorted by filename (date)

### Templates
- **Homepage:** `public/index.php` - Lists recent posts
- **Single post:** `public/post.php` - Displays individual posts
- **About page:** `public/about.php` - Static about page

## How to Add a New Post

1. Create a new file in `data/posts/` with the naming pattern:
   ```
   YYYY-MM-DD-your-post-slug.md
   ```

2. Start the file with a heading:
   ```markdown
   # Your Post Title
   
   Your post content here...
   ```

3. The post will automatically appear on the homepage

## Common Modifications

### Change the Blog Title
Edit the `<h1>` tag in `public/index.php`, `public/post.php`, and `public/about.php`.

### Modify the Color Scheme
Edit the CSS variables in `public/assets/style.css`:

```css
:root {
    --color-primary: #3b82f6;    /* Change to your brand color */
    --color-text: #1f2937;       /* Main text color */
    --color-bg: #ffffff;         /* Background color */
    /* ... */
}
```

### Add a New Page
1. Create a new PHP file in `public/` (e.g., `contact.php`)
2. Copy the structure from `about.php`
3. Add a link to the navigation in all header sections

### Add Post Categories
Consider adding a simple tag system by:
1. Adding tags to post filenames: `2026-02-16-tech-my-post.md`
2. Modifying `index.php` to filter by tag

## Security Notes

- The `data/` directory is outside the web root and protected
- Post slugs are validated with regex (`^[\w\-]+$`) to prevent traversal
- Always validate and sanitize user input if extending
