# NotesApp
A localized notekeeping app with basic note editing and user features. Developed using a MySQL database and PHP


***OVERVIEW:***

This application is developed using PHP, MySQL, CSS, HTML, and JS without the use of any frameworks. It provides the following functionalities:

**User Management:**
- Register new users
- Log in as existing users
- Delete the currently logged-in user

**Note Management:**
- Create notes
- Edit notes (can only be done by it's creator)
- Delete notes (can only be done by it's creator)
- View notes

These actions require authentication. However, viewing notes is possible without logging in.

Additionally, the application includes the following features:

- Colour Theme Switch Function
- Hidden Drop Database Function (/scripts/dropDatabase.php)
- Hidden Print Database Function (/pages/printServer.php)

***SETUP:***

To run this application, you need the following prerequisites:

1. **MySQL Community Server 8.2:**
   - Download link (Windows): [MySQL Community Server](https://dev.mysql.com/downloads/mysql/)
   - Exact download link used: [MySQL Community Server](https://dev.mysql.com/downloads/file/?id=523158)

   - *Installation:*
     - Follow the install wizard steps.
     - Open Windows Services using Win + R and typing "services.msc".
     - Find "MySQL82," left-click, and press start.

2. **PHP 8.3.0:**
   - Download link: [PHP 8.3.0](https://windows.php.net/download#php-8.3)
   - Exact download link used: [PHP 8.3.0 (NTS, Win32, VS16, x64)](https://windows.php.net/downloads/releases/php-8.3.0-nts-Win32-vs16-x64.zip)

   - *Installation:*
     - Install PHP in your main Windows drive (e.g., C:\php).
     - Follow the install wizard steps.
     - Add C:\php to the environmental variables in PATH.

   Ensure that the `mysqli` extension is enabled in the `php.ini` file, provided along with the application files in the "FOR INSTALL" folder.

   A system reboot is recommended for the environmental variables to work correctly.

The app is now ready to run. Go to the project's directory in CMD and type `php server.php` and go to http://localhost:8000/.