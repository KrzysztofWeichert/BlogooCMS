# BlogooCMS

Blogoo is a lightweight content management system (CMS) that allows you to manage a blog. It enables users to add, edit, and delete posts. \
App is using MySQLi to connect to the database and TinyMCE text editor to edit and add new posts.

## Features
- Log in
- Add an article
- Delete an article
- Edit an article
- Edit text on homepage
- Change meta title and description for SEO

## Requirements

- PHP 7.4+
- MySQL or another compatible database
- HTTP Server (e.g., Apache)
## Usage

1. Copy the files to your server.
2. Configure database access in src/config.php.
3. Import the database.sql file into your database.

## Structure

├── index.php           # Application entry point \
├── .htaccess           # Apache configuration \
├── Assets/             # Static files (CSS, JS, images) \
├── src/ \
│   ├── config.php      # Configuration file \
│   ├── functions.php   # Helper functions \
│   ├── View.php        # View handling \
│   ├── Controller/     # Application controllers \
│   ├── Model/          # Database models \
└── database.sql        # Database structure

## Planned new functionalities
- Adding an image to a new post
- Option to add new users/admins
- Feature that allows you to modify footer and add new static pages
- Option to change colors of the blog

## Author
Krzysztof Weichert
