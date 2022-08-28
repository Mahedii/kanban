# Overview

---

- [Installation Section](#section-1)

<a name="section-1"></a>
## Installation Section

<ul>
    <li>Download composer from <b>https://getcomposer.org/download/</b> and install it.</li>
    <li>Pull the Laravel/php project</li>
    <li>Rename <b>.env.example</b> file to <b>.env</b> inside your project root and fill the database information.</li>
    <li>Create a database locally named <b>kanban</b> utf8_general_ci</li>
    <li>Go to your project root folder</li>
    <li>Run this commands in the console one by one:</li>
</ul>

> {success} composer install or php composer.phar install

Run

> {success} php artisan key:generate

Run

> {success} php artisan migrate

Run

> {success} php artisan serve

<p>Now you can now access this project at <b><a target="_blank" href="http://127.0.0.1:8000/kanban">http://127.0.0.1:8000/kanban</a></b></p>
<p>You can now access this docs here at <b><a target="_blank" href="http://127.0.0.1:8000/docs">http://127.0.0.1:8000/docs</a></b></b></p>