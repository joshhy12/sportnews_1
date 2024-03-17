# Sport News Report Generator (Laravel)

## Overview

The Sport News Report Generator is a Laravel application that fetches and analyzes sports news articles from various sources to generate concise reports. It utilizes Laravel's powerful framework for web development, along with natural language processing (NLP) techniques to extract key information and present it in a structured format.

## Features

- Fetches sports news articles from multiple sources.
- Analyzes article content using NLP to extract important details.
- Generates concise reports summarizing the main points of each news article.
- Customizable options for selecting news sources and report formats.
- User-friendly interface for interacting with the application.

## Usage

1. Clone the repository to your local machine:

   ```
   git clone https://github.com/joshhy12/sportnews_1.git
   ```

2. Install Composer dependencies:

   ```
   composer install
   ```

3. Configure your environment variables:

   ```
   cp .env.example .env
   php artisan key:generate
   ```

   Update the `.env` file with your database and other configuration settings.

4. Run database migrations:

   ```
   php artisan migrate
   ```

5. Serve the application:

   ```
   php artisan serve
   ```

6. Access the application in your web browser.

## Requirements

- PHP >= 7.x
- Composer
- Laravel

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgements

- This project utilizes Laravel, a powerful PHP framework for web development.
- Natural language processing tasks are performed using external libraries and services.
