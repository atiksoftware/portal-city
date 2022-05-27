module.exports = {
    content: [
        "./resources/js/**/*.js", 
        "./resources/views/auth/*.blade.php",    
    ],
    theme: {
        extend: { 
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
