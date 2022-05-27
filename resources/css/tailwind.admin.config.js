module.exports = { 
    content: [
        "./resources/js/**/*.js", 
        "./resources/views/admin/**/*.blade.php",  
        "./resources/views/vendor/**/*.blade.php",   
        "./resources/views/components/*.blade.php",   
        "./resources/views/app/widgets/*.blade.php",   
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
