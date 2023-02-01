# texnes-ellinikosxoleio

Α Conference Management System for the conference entitled "Τέχνες στο Ελληνικό Σχολείο".

You may view the real-world deployment of the software here:
https://texnes-ellinikosxoleio.uoa.gr/


##### Deployment

1.  Extract the archive and put it in the folder you want

2.  Run `cp .env.example .env` file to copy example file to `.env`. 
    Then edit your `.env` file with DB credentials and other settings.

3.  Run `composer install` command

4.  Run `php artisan migrate --seed` command.
    Notice: seed is important, because it will create the first admin user for you.

5.  Run `php artisan key:generate` command.

6.  If you have file/photo fields, run `php artisan storage:link` command.

And that's it, go to your domain and login:

##### Default credentials

Username: `admin@admin.com`

Password: `password`

##### Demo deployment

You may view a demo deployment with fake data here:
https://conference-management-system.gateweb.gr/

Use the same credentials as above.

#### License

This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.