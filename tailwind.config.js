module.exports = {
  purge: [],
  theme: {
    extend: {
      spacing: { full: "100%" }
    },
    spinner: theme => ({
      default: {
        color: theme("colors.gray.100"),
        size: "4em",
        border: "3px"
      }
    })
  },
  variants: {
    spinner: ["responsive"]
  },
  plugins: [
    require("tailwindcss-spinner")() // no options to configure
  ]
};
