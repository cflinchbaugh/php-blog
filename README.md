# php-blog
Procedural PHP set up supports:
    User creation, login, and logout
    Uploading profile image
    Reading and creating articles

Runs on a local database, assumes the following:
    database name: php_procedural_login
    varChar(255) unless noted otherwise

    table: profile_image
    columns: 
        id (key) int,
        user_id,
        status int;

    table: users
    columns: 
        id (key) int,
        user_id,
        user_name,
        user_email,
        user_password 

    table: article
    columns: 
        article_id (key), 
        article_title, 
        article_text LONGTEXT,
        article_author, 
        article_date DATE;



