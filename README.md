## Laravel Test Task

## Requirements
- PHP 7.4
- enabled ext-dom php extension

### Instalation required steps
- run npm run dev
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
