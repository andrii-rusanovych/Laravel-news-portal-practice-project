## Laravel News Portal Practice Project

### Project Details

- **Development Time:** This project was initially developed in a week to demonstrate my skills.
- **Readme Enhancements:** I've made improvements to the README to ensure clarity and ease of setup for anyone interested in this project.
- **Git Fixes:** I've also addressed issues with Git-related files to make it more accessible for others to fetch and set up the project as expected.

### This repository contains a Laravel-based project I worked on to enhance my skills. It's a news portal with two components:
1. Admin Panel:
  * Authentication for admin access.
  * Ability to add, edit, and delete news articles.
  * News article details include title, photo, tags, text, creation date, and activity status.
2. Mini Website:
  * The main page displays a list of active news articles with titles, photos, and creation dates.
  * Individual news article pages with breadcrumbs, title, creation date, photo, and text.
  * Pagination for news articles.
  * Sorting of news articles by creation date.
  * Navigation buttons for previous and next articles.

#### Tag Handling:
- When adding tags to an article, if the tag already exists in other articles, a validation error message is displayed in the admin panel to ensure tag uniqueness.
- Tags are automatically wrapped into <a> HTML tags in the article text to create clickable links.
- Custom links within the rich text of articles are preserved and not replaced, even if they match the tag name.
- The system intelligently manages tag replacements to avoid unintended changes, especially within custom links or special cases.

## Requirements
- PHP 7.4
- enabled ext-dom php extension

### Instalation required steps
- run composer install
- run php artisan key:generate
- run php artisan migrate --seed

### Aditional steps
Set this enviromental variables to seed user, default user will be seeded otherwise with default values provided in  - config/seeder.php
- SEEDER_USER_EMAIL=your_email
- SEEDER_USER_NAME=your_user_name
- SEEDER_USER_PASSWORD=your_user_password

[laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
run to disable PHPStorm warnings about custom Laravel Facades
- php artisan ide-helper:generate


By default BROADCAST_DRIVER is set to 'log' so email for password reset can be found under storage/logs/laravel.log

### Custom artisan commands:
- php artisan seeder:cleanup

#### This project uses [TinyEditor](https://www.tiny.cloud/), plugins used:
- anchor: Anchor - Insert anchors (also known as bookmarks) in your content to create internal links.
- autolink: Autolink - Automatically create hyperlinks when typing URLs.
- autoresize: Autoresize - Automatically resize the TinyMCE editor to fit the content.
- charmap: Character Map - Insert special characters into the content.
- code: Code - Edit the HTML source code of the content.
- emoticons: Emoticons - Insert emoticons (smileys) into the content.
- fullscreen: Full Screen - Toggle the TinyMCE editor to full-screen mode.
- image: Image - Insert and manage images in the content.
- link: Link - Add and manage hyperlinks in the content.
- lists: Lists - Create and manage bulleted and numbered lists.
- media: Media - Insert and manage HTML5 video and audio elements.
- preview: Preview - Display a preview of the current content in a read-only format.
- searchreplace: Search and Replace - Find and replace text within the content.
- table: Table - Add and manage tables in the content.
- visualblocks: Visual Blocks - Display block-level elements like paragraphs with visual cues.
- visualchars: Visual Characters - Show invisible characters, such as non-breaking spaces and other whitespace.
- wordcount: Word Count - Display a word count for the content.
#### [TinyEditor all available free plugins list](https://www.tiny.cloud/docs/plugins/opensource/)
