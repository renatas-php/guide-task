/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      spacing: {
        '16px': '16px',
        '25px': '25px',
        '32px': '32px',
        '64px': '64px',
        '100px': '100px',
        '800px': '800px'
      },
      colors: {
        'bgColor': '#f8f3ff',
        'purpleButton': 'rgb(114 101 210)',
        'veryDarkPurple': '#080043'
      },
      borderRadius: {
        '2px': '2px',
        '10px': '10px'
      },
      fontSize: {
        '24px': '24px',
        '28px': '28px',
        '48px': '48px',
      },
      lineHeight: {
        '48px': '48px'
      }
    },
  },
  plugins: [],
}

