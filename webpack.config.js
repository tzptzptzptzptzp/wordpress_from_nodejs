const path = require("path");
const CopyWebpackPlugin   = require('copy-webpack-plugin');

module.exports = {
    devtool: "hidden-source-map",
    entry: {
        index: "./src/js/index.ts",
        single: "./src/js/single.ts",
        archive: "./src/js/archive.ts",
        page: "./src/js/page.ts",
        lazyload: "./src/js/module/lazyload.js",
    },
    output: {
        path: path.resolve(__dirname, "dist/assets/js"),
        filename: "[name].js",
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: 'ts-loader',
            },
        ],
    },
    resolve: {
        extensions: [
            '.ts', '.js',
        ],
    },
    plugins: [
        new CopyWebpackPlugin({
            patterns: [
                {
                    context: "src/css/",
                    from: `*.min.css`,
                    to: `${__dirname}/dist/assets/css/`,
                },
            ]
        }),
    ],
    devServer: {
        contentBase: path.resolve(__dirname, "dist/assets/js"),
    },
    cache: true,
};
