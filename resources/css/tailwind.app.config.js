module.exports = { 
    content: [
        "./resources/js/**/*.js", 
        "./resources/views/app/**/*.blade.php",   
        "./resources/views/vendor/**/*.blade.php",   
        "./resources/views/components/*.blade.php",  
    ],
    theme: {
        extend: {
            spacing: {
                '119': '29.75rem',
                '320': '80rem',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
