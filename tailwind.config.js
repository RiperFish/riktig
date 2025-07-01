module.exports = {
  content: [
    "./resources/views/**/*.php",
    "./resources/js/**/*.js",
    "./**/*.php",
  ],
  theme: {
    screens: {
      sm: { max: "639px" }, // up to 639px
      md: { max: "767px" }, // up to 767px
      lg: { max: "1023px" }, // up to 1023px
      xl: { max: "1279px" }, // up to 1279px
      "2xl": { max: "1535px" }, // up to 1535px
    },
    extend: {},
  },
  plugins: [],
};
