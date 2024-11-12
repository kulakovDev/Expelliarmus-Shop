/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './index.html',
        './src/**/*.{vue,js,ts,jsx,tsx}',
    ],
    darkMode: "class",
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'sans-serif']
            },
            spacing: {
                '272': '17rem',
                '352': '22rem',
                '670': '45rem'
            },
            fontSize: {
                '54': '3.375rem'
            },
            width: {
                '68': '16.875rem'
            },
            maxHeight: {
                '712' : '44.5rem'
            },
            boxShadow: {
                'dark-mode': 'rgba(255, 255, 255, 0.24) 0px 3px 8px',
                'light-mode': 'rgba(0, 0, 0, 0.24) 0px 3px 8px'
            },
            screens: {
                '3xl': '1728px'
            }
        },
        container: {
            center: true,
            screens: {
                sm: "640px",
                md: "728px",
                lg: "1024px",
                xl: "1280px",
                '2xl': "1536px",
                '3xl': "1728px",
            },
        },
    },
    plugins: [],
}

