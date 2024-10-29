/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './index.html',
        './src/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'sans-serif']
            },
            spacing: {
                '272': '17rem',
                '352': '22rem'
            }
        },
    },
    plugins: [],
}

