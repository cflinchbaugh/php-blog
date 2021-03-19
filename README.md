# php-procedural-login
Procedural PHP set up for user creation, login, and logout.
Supports uploading files and setting a user profile image.

Runs on a local database, assumes the following:
database name: php_procedural_login

varChar(255) unless noted otherwise

table: profile_image
columns: id (key) int, user_id, status int;

table: users
columns: id (key) int, user_id, user_name, user_email, user_password 



