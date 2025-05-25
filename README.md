# WordPress 5 Project

## Overview
This is a WordPress 5 website project. This README provides essential information for development, deployment, and maintenance of the site.

## Installation

### Requirements
- PHP 7.4 or higher
- MySQL 5.6 or higher / MariaDB 10.1 or higher
- Web server (Apache, Nginx, etc.)
- Node.js and npm (for theme development)

### Local Development Setup
1. Clone this repository
   ```
   git clone [repository-url] e:\Projects\hvtek_WP
   ```
2. Set up a local server environment (XAMPP, WAMP, Local by Flywheel, etc.)
3. Create a database for WordPress
4. Copy `wp-config-sample.php` to `wp-config.php` and configure database settings
5. Access the site in your browser and complete the WordPress installation

## Project Structure
```
hvtek_WP/
├── wp/                  # WordPress core files (if using subdirectory installation)
├── wp-content/          # Themes, plugins, and uploads
│   ├── themes/          # Custom themes
│   ├── plugins/         # Custom and third-party plugins
│   └── uploads/         # Media files (not in repository)
├── wp-config.php        # WordPress configuration (not in repository)
└── .gitignore           # Git ignore rules
```

## Development Workflow

### Theme Development
1. Navigate to your custom theme directory
   ```
   cd wp-content/themes/[theme-name]
   ```
2. Install dependencies
   ```
   npm install
   ```
3. Run build process
   ```
   npm run build
   ```
4. For development with watch mode
   ```
   npm run dev
   ```

### Plugin Development
Custom plugins should be developed in the `wp-content/plugins/[plugin-name]` directory.

## Deployment
1. Push changes to the repository
2. Pull changes on the production server
3. Run database migrations if necessary
4. Update WordPress core, themes, and plugins via the admin panel

## Backup
Regular backups should include:
- Database (via phpMyAdmin, WP plugin, or command line)
- Uploads directory
- Custom themes and plugins

## Security
- Keep WordPress core, themes, and plugins updated
- Use strong passwords
- Implement security plugins
- Limit login attempts

## Contributing
1. Create a feature branch from `develop`
2. Make changes and test thoroughly
3. Submit a pull request to `develop`

## License
This project is licensed under the [appropriate license] - see the LICENSE file for details.
