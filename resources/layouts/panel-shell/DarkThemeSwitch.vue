<script setup lang="ts">
import { MoonStar, SunMoon } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'

const isDark = useDark()
const toggleDark = useToggle(isDark)
</script>

<template>
  <Button
    class="size-9"
    aria-label="Toggle dark mode"
    variant="ghost"
    size="icon"
    @click="toggleDark()"
  >
    <SunMoon
      v-if="isDark"
      class="size-6"
    />
    <MoonStar
      v-else
      class="size-6"
    />
  </Button>
</template>
