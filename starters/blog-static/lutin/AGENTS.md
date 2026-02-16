# Project Guide

This is your flat-file blog. All content is stored as Markdown files — no database required.

## Project Structure

```
├── public/              # Web-accessible files
│   ├── index.php        # Blog homepage
│   ├── post.php         # Single post view
│   ├── about.php        # About page
│   └── assets/
│       └── style.css    # Main stylesheet
├── src/                 # Private PHP logic
├── data/
│   └── posts/           # Markdown blog posts
└── lutin/
    └── AGENTS.md        # This file
```

## Managing Content

### Adding a New Blog Post

1. Create a file in `data/posts/` named with the pattern:
   ```
   YYYY-MM-DD-your-post-slug.md
   ```

2. Start with a heading:
   ```markdown
   # Your Post Title
   
   Your content here...
   ```

3. The post appears automatically on the homepage

### Editing Existing Posts

Simply modify the Markdown files in `data/posts/`. Changes are immediate.

## Customization

### Site Title
Edit the `<h1>` text in:
- `public/index.php` (homepage header)
- `public/post.php` (post page header)
- `public/about.php` (about page header)

### Colors & Styling
Edit `public/assets/style.css`:

```css
:root {
    --color-primary: #3b82f6;    /* Links, buttons */
    --color-text: #1f2937;       /* Body text */
    --color-bg: #ffffff;         /* Background */
    --color-bg-alt: #f9fafb;     /* Alternate background */
}
```

### Adding Pages
1. Create `public/your-page.php`
2. Copy structure from `public/about.php`
3. Add navigation link in all page headers

## Security Notes

- `data/` is outside the web root and cannot be accessed directly
- Post URLs are validated to prevent directory traversal
- Always sanitize any new user input if extending functionality
