<?php

return [
    'show_warnings' => false,
    'public_path' => null,
    'convert_entities' => true,

    'options' => [
        'font_dir' => public_path('fonts'),  // Ensure this is public/fonts
        'font_cache' => public_path('fonts'),  // Font cache in public/fonts
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'Amiri',  // Set to 'Amiri' as the default font
        'dpi' => 72,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => false,
        'allowed_remote_hosts' => null,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,

        // Add the log file setting here
        'log_output_file' => storage_path('logs/dompdf.log'), // Log file for dompdf errors
    ],

    'font_family' => [
        'Amiri' => [  // Register Amiri font for Arabic
            'R'  => 'Amiri-Regular.ttf',    // Regular
            'B'  => 'Amiri-Bold.ttf',       // Bold
            'I'  => 'Amiri-Italic.ttf',     // Italic
            'BI' => 'Amiri-BoldItalic.ttf'  // Bold Italic
        ],
        'Tajawal' => [  // Register Tajawal font for Arabic
            'R'  => 'Tajawal-Regular.ttf',    // Regular
            'B'  => 'Tajawal-Bold.ttf',       // Bold
            'I'  => 'Tajawal-Light.ttf',      // Light (can act as Italic)
            'BI' => 'Tajawal-ExtraBold.ttf'   // Extra Bold
        ],
    ],
];
