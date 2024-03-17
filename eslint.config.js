// @ts-check
import antfu from '@antfu/eslint-config'
import { FlatCompat } from '@eslint/eslintrc'

const flatCompat = new FlatCompat()

export default antfu({
  formatters: {
    css: true,
    html: true,
  },
  vue: true,
}, flatCompat.config({
  extends: ['plugin:tailwindcss/recommended'],
  rules: {
    'tailwindcss/no-custom-classname': 'off',
  },
}))
