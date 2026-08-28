const CopyWebpackPlugin = require("copy-webpack-plugin");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require("path");

module.exports = {
	...defaultConfig,
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.ts$/,
				use: {
					loader: "ts-loader",
					options: {
						transpileOnly: false,
						compilerOptions: {
							forceConsistentCasingInFileNames: true,
						},
					},
				},
				exclude: /node_modules/,
			},
		],
	},
	watchOptions: {
		ignored: /node_modules/,
		aggregateTimeout: 300,
		poll: 1000,
	},
	plugins: [
		...defaultConfig.plugins,
		new CopyWebpackPlugin({
			patterns: [
				{
					from: path.resolve(__dirname, "blocks/**/*.{svg,webp,png,jpg,jpeg}"),
					to: path.resolve(__dirname, "build"),
					noErrorOnMissing: true,
				},
			],
		}),
	],
	resolve: {
		...defaultConfig.resolve,
		extensions: [".ts", ".tsx", ".js", ".jsx"],
	},
};
