module.exports = {
    root: true,
    env: {
        browser: true,
        commonjs: true,
        es6: true,
    },
    extends: [
        "plugin:prettier/recommended",
        "plugin:vue/essential",
        "prettier/vue",
    ],
    plugins: [
      "vue"
    ],
    globals: {
        axios: true,
        Atomics: "readonly",
        SharedArrayBuffer: "readonly",
    },
    parserOptions: {
        ecmaVersion: 2018,
    },
    rules: {
        "prettier/prettier": [
            "error",
            {
                tabWidth: 4,
                semi: false,
                singleQuote: true,
            },
        ],
    },
};