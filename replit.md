# Overview

This is a Laravel-based exam results system that provides an Arabic-friendly platform for displaying and managing student exam results. The application features a search interface, PDF generation capabilities with Arabic font support, and is built with Laravel 11 framework. The system includes both web interface and PDF export functionality with proper Arabic text rendering using specialized fonts.

# User Preferences

Preferred communication style: Simple, everyday language.

# System Architecture

## Backend Architecture
- **Framework**: Laravel 11 using PHP 8.2+
- **MVC Pattern**: Following Laravel's Model-View-Controller architecture
- **Package Management**: Composer for PHP dependencies
- **Asset Management**: Vite for frontend build process with Laravel integration

## Frontend Architecture
- **Build System**: Vite configuration for CSS and JavaScript compilation
- **Styling**: Custom CSS with gradient backgrounds and responsive design
- **JavaScript**: Minimal JavaScript setup with Axios for HTTP requests
- **UI Components**: Form-based interface with search functionality

## PDF Generation System
- **PDF Library**: DomPDF (v3.0) for HTML-to-PDF conversion
- **Arabic Support**: Integrated Arabic text processing via khaled.alshamaa/ar-php library
- **Font Management**: Multiple Arabic fonts (Amiri, Tajawal) with Unicode Font Metrics (UFM) support
- **Custom HTML Renderer**: Laravel-Arabic-HTML package for proper Arabic text rendering in PDFs

## Data Processing
- **Arabic Text Processing**: ArPHP library for Arabic language handling and text manipulation
- **Font Rendering**: Custom font files and metrics for accurate Arabic text display
- **PDF Styling**: CSS-based styling with Arabic font fallbacks

## Development Tools
- **Code Quality**: Laravel Pint for code formatting
- **Testing Framework**: PHPUnit for unit testing
- **Error Handling**: Whoops error handler for development debugging
- **Development Server**: Laravel Sail for containerized development environment

# External Dependencies

## Core Framework
- **Laravel Framework 11.9**: Main application framework
- **Laravel Tinker**: REPL for Laravel application interaction

## PDF Generation
- **barryvdh/laravel-dompdf**: Laravel wrapper for DomPDF
- **dompdf/dompdf**: Core PDF generation library
- **dompdf/php-font-lib**: Font parsing and processing
- **dompdf/php-svg-lib**: SVG rendering support

## Arabic Language Support
- **khaled.alshamaa/ar-php**: Arabic text processing and language utilities
- **salmankavanur/laravel-arabic-html**: Custom Arabic HTML rendering for Laravel

## HTTP and Utilities
- **guzzlehttp/guzzle**: HTTP client library
- **fruitcake/php-cors**: Cross-Origin Resource Sharing support
- **graham-campbell/result-type**: Result type implementation
- **dragonmantank/cron-expression**: Cron expression parser

## Development Dependencies
- **fakerphp/faker**: Data generation for testing
- **filp/whoops**: Error handling and debugging
- **hamcrest/hamcrest-php**: Matcher library for testing
- **mockery/mockery**: Mocking framework for tests

## Frontend Build Tools
- **Vite**: Modern frontend build tool
- **Axios**: HTTP client for JavaScript
- **laravel-vite-plugin**: Laravel integration for Vite