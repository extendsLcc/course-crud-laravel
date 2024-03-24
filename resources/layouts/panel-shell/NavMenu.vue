<script setup lang="ts">
import type { FunctionalComponent } from 'vue'
import { GraduationCap, HomeIcon } from 'lucide-vue-next'
import { buttonVariants } from '@/components/ui/button'
import { cn } from '@/lib/utils'

const navbarItemsConfig: Array<{
  name: string
  href: string // since route() always returns string, I cannot enforce coupling with RouteName
  routeNamePattern: string // RouteName - duplicated code, but it's to keep IDE go-to-definition working a
  icon: FunctionalComponent
}> = [
  { name: 'Home', href: route('home'), routeNamePattern: 'home', icon: HomeIcon },
  { name: 'Courses', href: route('courses.index'), routeNamePattern: 'courses.*', icon: GraduationCap },
]

const router = useRoute()
</script>

<template>
  <!-- This will force trigger re-render when navigating, updating active link -->
  <nav :key="router.current.value" class="flex flex-col gap-1 p-2">
    <router-link
      v-for="navItem in navbarItemsConfig"
      :key="navItem.href"
      :href="navItem.href"
      :class="cn(
        buttonVariants({ variant: router.matches(navItem.routeNamePattern) ? 'default' : 'ghost', size: 'sm' }),
        router.matches(navItem.routeNamePattern) && 'dark:bg-muted dark:text-white dark:hover:bg-muted dark:hover:text-white',
        'justify-start',
      )"
    >
      <component :is="navItem.icon" class="mr-2 size-4" />
      {{ navItem.name }}
    </router-link>
  </nav>
</template>
