/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
	theme: {
		extend: {
			colors: {
				dark: "#12121e",
				"dark-100": "#292e41",
				"dark-200": "#080a31",
				"dark-300": "#070724",
				"dark-400": "#030312",
				"metablue-100": "#17c8f6",
				"metablue-200": "#319df5",
				"metablue-300": "#3f87f3",
				"metablue-400": "#4d75f4",
			},
		},
	},
	plugins: [],
};
