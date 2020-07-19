module.exports = {
  purge: [],
  theme: {
    extend: {
      spacing: { full: "100%", "72": "18rem", "96": "24rem" },
      minHeight: theme => ({
        ...theme("spacing")
      })
    },
    spinner: theme => ({
      default: {
        color: theme("colors.gray.100"),
        size: "4em",
        border: "3px"
      },
      sm: {
        color: theme("colors.gray.100"),
        size: "1em",
        border: "2px"
      }
    })
  },
  variants: {
    spinner: ["responsive"],
    backgroundColor: ["responsive", "hover", "focus", "active"]
  },
  plugins: [
    require("tailwindcss-spinner")() // no options to configure
  ]
};
