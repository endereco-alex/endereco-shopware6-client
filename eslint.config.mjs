import { defineConfig } from "eslint/config";
import globals from "globals";
import js from "@eslint/js";

export default defineConfig([
  {
    files: ["endereco.js"],
    languageOptions: {
      globals: {
        ...globals.browser,
        jQuery: "readonly",
        enderecoLoadAMSConfig: "readonly",
      }
    },
    plugins: { js },
    extends: ["js/recommended"],
    rules: {
      "no-unused-vars": ["error", { argsIgnorePattern: "^_" }],
    },
  },
  {
    files: ["src/Resources/app/**/*.js"],
    languageOptions: {
      globals: {
        ...globals.browser,
        Shopware: "readonly",
      }
    },
    plugins: { js },
    extends: ["js/recommended"],
    rules: {
      "no-unused-vars": ["error", { argsIgnorePattern: "^_" }],
    },
  },
]);