<script setup lang="ts">
import { cva } from 'class-variance-authority'
import { computed } from 'vue'

interface KbdProps {
  as?: string
  size?: 'xs' | 'sm' | 'md'
}

const props = withDefaults(defineProps<KbdProps>(), {
  as: 'kbd',
  size: 'sm',
})

const kbdClass = computed(() => {
  return cva(
    'pointer-events-none inline-flex h-5 select-none items-center gap-1 rounded border border-border bg-muted font-sans font-medium',
    {
      variants: {
        size: {
          xs: 'h-4 min-h-4 px-1 text-[10px]',
          sm: 'h-5 min-h-5 px-1 text-[11px]',
          md: 'h-6 min-h-6 px-1.5 text-[12px]',
        },
      },
    },
  )({
    size: props.size,
  })
})
</script>

<template>
  <component :is="props.as" :class="kbdClass">
    <slot />
  </component>
</template>
