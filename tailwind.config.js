/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
	theme: {
		extend: {
			colors: {
				dark: "#12121e",
				"dark-100": "#292e41",
				"dark-200": "#121223",
				"dark-300": "#070724",
				"dark-400": "#030312",
				"dark-500": "#0a0b1b",
				"metablue-100": "#17c8f6",
				"metablue-200": "#319df5",
				"metablue-300": "#3f87f3",
				"metablue-400": "#4d75f4",
				steal: "#61dcd9",
			},
			fontFamily: {
				gothic: ["Gothic+A1", "ui-sans-serif"],
				"gothic-league": ["League Gothic", "ui-sans-serif"],
			},
			spacing: {
				1.5: "0.3rem",
			},
		},
	},
	plugins: [],
};
