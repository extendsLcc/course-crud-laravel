import type { Config } from 'tailwindcss'

import tailwindForms from '@tailwindcss/forms'

export default {
  content: [
    './resources/**/*.{js,ts,vue,blade.php}',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    tailwindForms,
  ],
} satisfies Config
