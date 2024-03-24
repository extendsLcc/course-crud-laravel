import { initializeHybridly } from 'virtual:hybridly/config'
import { createHead } from '@unhead/vue'
import './tailwind.css'

initializeHybridly({
  enhanceVue: (vue) => {
    const head = createHead()
    head.push({
      titleTemplate: title => title ? `${title} - Course CRUD Laravel` : 'Course CRUD Laravel',
    })
    vue.use(head)
  },
})
