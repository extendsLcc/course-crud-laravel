import { initializeHybridly } from 'virtual:hybridly/config'
import { createHead } from '@unhead/vue'
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import './tailwind.css'

initializeHybridly({
  enhanceVue: (vue) => {
    const head = createHead()
    head.push({
      titleTemplate: title => title ? `${title} - Course CRUD Laravel` : 'Course CRUD Laravel',
    })
    vue
      .use(head)
      .use(autoAnimatePlugin)
  },
})
