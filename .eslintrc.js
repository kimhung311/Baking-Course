module.exports = {
  root: true,
  parser: 'vue-eslint-parser',
  parserOptions: {
    parser: '@babel/eslint-parser',
    ecmaVersion: 2018,
    sourceType: 'module'
  },
  extends: [
    'plugin:vue/recommended',
    'standard',
    'eslint no-extra-semi',
  ],
  rules: {
        'vue/max-attributes-per-line': 'off'
    }
}
