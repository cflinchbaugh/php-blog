# php-procedural-login
Procedural PHP set up for user creation, login, and logout.
Supports uploading files and setting a user profile image.

Runs on a local database, assumes the following:
database name: php_procedural_login

table: profile_image
columns: id (key), user_id, status;

table: users
columns: user_id (key), user_name, user_email, user_password 



