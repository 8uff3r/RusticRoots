import animate from 'tailwindcss-animate';
import forms from '@tailwindcss/forms';
export default {
  plugins: {
    tailwindcss: {
      darkMode: ['class'],
      content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{ts,tsx,vue}'
      ],
      prefix: '',
      theme: {
        container: {
          center: true,
          padding: '2rem',
          screens: {
            '2xl': '1400px'
          }
        },
        extend: {
          keyframes: {
            'accordion-down': {
              from: { height: 0 },
              to: { height: 'var(--radix-accordion-content-height)' }
            },
            'accordion-up': {
              from: { height: 'var(--radix-accordion-content-height)' },
              to: { height: 0 }
            }
          },
          animation: {
            'accordion-down': 'accordion-down 0.2s ease-out',
            'accordion-up': 'accordion-up 0.2s ease-out'
          }
        }
      },
      plugins: [animate, forms]
    },
    autoprefixer: {}
  }
};
