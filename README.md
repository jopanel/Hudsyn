
<img width="861" alt="Hudsyn Dashboard" src="https://github.com/user-attachments/assets/d4e83177-320f-4040-8a66-fd62a2c58dad" />

# Hudsyn – A Free Headless CMS for Laravel

**Hudsyn** is a lightweight, headless content management system designed specifically for Laravel projects. Born from the need to quickly manage a beautiful, fast-loading landing page without the overhead of systems like WordPress or expensive alternatives such as Statamic, Hudsyn allows you to manage pages, blog posts, press releases, custom routes, layouts, settings, and file uploads—all from within your Laravel application.

## What is Hudsyn?

Hudsyn is a modular CMS that integrates directly into your Laravel project. It provides:

- **Admin Dashboard:**  
  A comprehensive admin interface to manage your content, including:
  - **Pages:** Create, edit, and publish pages that generate static HTML files for lightning-fast public display.
  - **Blog Posts:** Manage blog posts with rich text editing, author assignment, and static file generation.
  - **Press Releases:** Similar to blog posts, for press announcements.
  - **Custom Routes:** Define custom URL mappings to any content type.
  - **Layout Management:** Configure header and footer layouts that can be applied to your pages.
  - **Global Settings:** Manage key–value pairs that can be injected into your content.
  - **File Upload & Gallery:** Upload files, view image thumbnails, and quickly insert images into your WYSIWYG editor.

- **Public-Facing Pages:**  
  Hudsyn generates static HTML files for public pages, ensuring your landing page loads quickly and efficiently.

- **WYSIWYG Editor Integration:**  
  The admin interface includes a rich text editor (CKEditor) with support for direct image uploads and gallery browsing.

## Why Use Hudsyn?

- **Seamless Integration:**  
  Designed to be installed into any Laravel project without interfering with your existing architecture.

- **Performance:**  
  Static file generation provides a high-performance public site while allowing dynamic content management.

- **Flexibility & Customization:**  
  Easily extend or modify any aspect of the CMS to meet your specific needs.

- **Cost-Effective:**  
  A free, open-source solution that avoids the complexity of larger CMS systems.

## Installation

Hudsyn is packaged as a Composer package for easy integration into your existing Laravel project. *Currently laravel 11+ && PHP8+ is supported*

### Step 1: Require the Package

Run the following Composer command from your Laravel project root:

```bash
composer require jopanel/hudsyn:^1.0.8
```

### Step 2: Publish the Package Assets

Publish Hudsyn’s assets (views, migrations, seeders, and public assets) to your Laravel project using Artisan:

```bash
php artisan vendor:publish --tag=hudsyn-config
php artisan vendor:publish --tag=hudsyn-views
php artisan vendor:publish --tag=hudsyn-migrations
php artisan vendor:publish --tag=hudsyn-seeders
php artisan vendor:publish --tag=hudsyn-public
```

> **Note:** The public assets include folders for `static/blog`, `static/pages`, and `static/press`. Ensure these directories are created in your `public/vendor/hudsyn` folder after publishing.

### Step 3: Run the Migrations

Create the necessary database tables by running:

```bash
php artisan migrate
```

### Step 4: (Optional) Seed the Database

If you wish to create an initial admin user or other sample data, run the seeder provided:

```bash
php artisan db:seed --class=AdminUserSeeder
```

### Step 5: Configure Middleware and Routes

Hudsyn comes with its own routes and a custom middleware that protects the admin interface. The package’s service provider automatically registers these. Ensure your authentication is set up and that your custom middleware alias (`hudsyn`) is recognized if you need to customize it.

### Step 6: Creating and Editing Pages/Blogs/Press Releases

You can add your css and script files in `/config/hudsyn.php` which will be loaded within the WYSIWYG editor. Easily modify the header and footer file for your press release, blog, and pages within the `/resources/views/vendor/hudsyn/hudsyn/public/*` folder. For pages you can specify your own custom header and footer as well load them customized to your needs based on the layout view file.

## How Hudsyn Works

- **Admin Interface:**  
  Once installed, you can access the Hudsyn admin panel by navigating to `/hudsyn` in your browser. Here you can:
  - Log in and manage users, pages, blog posts, press releases, custom routes, layouts, and global settings.
  - Use the integrated WYSIWYG editor for rich content creation.
  - Upload files and view an image gallery with thumbnail previews.

- **Static File Generation:**  
  When you publish content (pages, blog posts, or press releases), Hudsyn automatically generates a static HTML file in the appropriate folder (e.g., `public/static/pages`). This ensures fast load times for public-facing content.

- **Public Routes:**  
  The package registers public routes that serve your landing page, blog posts (e.g., `/blog/{slug}`), press releases (e.g., `/press/{slug}`), or any custom route you define. The CMS checks for a corresponding static file and serves it if available.

## Customization

Hudsyn is designed to be modular and easily extendable:

- **Views:**  
  All admin and public views are published to your project’s `resources/views/vendor/hudsyn` folder, so you can modify them to match your design.

- **Migrations & Seeders:**  
  The database structure is published so you can customize fields if needed.

- **Service Provider:**  
  The package’s service provider (`Jopanel\Hudsyn\HudsynServiceProvider`) registers routes, views, migrations, and public assets. You can modify this if you require custom behavior.

## Contributing

Contributions are welcome! Please fork the repository, make your changes, and submit a pull request. For any major changes, please open an issue first to discuss your ideas.

## License

This project is open-sourced under the [MIT license](LICENSE).

---

Happy coding and enjoy using Hudsyn in your Laravel projects!