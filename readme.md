# DNS Record Management Application

This application provides an easy and convenient way to manage DNS records using the GoDaddy API. It allows you to list, add, change, and delete DNS records for your domain.

## Features
- List DNS records for your domain
- Add new DNS records to your domain
- Change existing DNS records for your domain
- Delete DNS records from your domain

## Requirements
- PHP 7.0 or higher
- Access to GoDaddy API with API Key and API Secret
- Domain name hosted with GoDaddy

## Getting Started
1. Clone the repository to your local machine.
2. Create a config.php file in the root directory and store your GoDaddy API Key, API Secret, and domain name as constants.
3. Run the application on a web server or local server such as XAMPP or WAMP.
4. Login to the application using the credentials stored in users.php.
5. Use the menu to access the different DNS record management pages.

## Notes
- The user credentials are stored in the users.php file in a secure manner using password hashing.
- The application is designed using Bootstrap for a responsive and user-friendly interface.
- The data in the list DNS records table is wrapped when it is too long to fit within the cell using the CSS `word-wrap` property.

## Support
In case of any issues or for further assistance, please feel free to reach out to us.
