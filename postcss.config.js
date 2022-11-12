module.exports = (context) => {
  return {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
      cssnano: context.env === "production" ? {} : false,
    },  
  };
};
