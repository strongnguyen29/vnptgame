module.exports = {
  purge: [
      './resources/views/errors/*.blade.php',
      './resources/views/front/**/*.blade.php',
      './resources/views/components/front/**/*.blade.php',
      './resources/views/vendor/**/*.blade.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
      fontFamily: {
          sans: ['Roboto', 'Arial', 'sans-serif'],
          title: ['Oswald', 'Arial',  'sans-serif'],
          serif: ['Merriweather', 'serif'],
      },
      container: false,
      backgroundSize: {
          'auto': 'auto',
          'cover': 'cover',
          'contain': 'contain',
          'zoom': '125%',
      },
      extend: {
          backgroundSize: {
              'zoom': '125%',
          },
          transitionDuration: {
              '3000': '3000ms',
              '5000': '5000ms'
          },
          colors: {
              'gray-850': '#171719',
          },
          animation: {
            viewMore: 'transform: rotate(90deg) animation: bounce 1s infinite;'
          }
      },
  },
  variants: {
    extend: {
        display: ['responsive', 'group-hover'],
        borderWidth: ['hover', 'group-hover'],
        inset: ['hover', 'group-hover', 'focus'],
        transform: ['hover', 'group-hover', 'focus'],
        translate: ['active', 'group-hover'],
        scale: ['active', 'group-hover'],
    },
  },
  plugins: [
      require('@tailwindcss/aspect-ratio'),
      require('@tailwindcss/line-clamp'),
      function ({ addComponents }) {
          addComponents({
              '.container': {
                  maxWidth: '100%',
                  marginRight: 'auto',
                  marginLeft: 'auto',
                  paddingRight: '1rem',
                  paddingLeft: '1rem',
                  '@screen sm': {
                      maxWidth: '640px',
                  },
                  '@screen md': {
                      maxWidth: '768px',
                  },
                  '@screen lg': {
                      maxWidth: '1024px',
                  },
                  '@screen xl': {
                      maxWidth: '1200px',
                  },
                  '@screen 2xl': {
                      maxWidth: '1200px',
                  },
              }
          })
      }
  ],
};
