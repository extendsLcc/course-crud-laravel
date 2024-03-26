<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'

const props = defineProps<{
  class?: HTMLAttributes['class']
}>()
</script>

<template>
  <tr :class="cn('border-b transition-colors dark:hover:bg-muted/50 hover:bg-muted/25 data-[state=selected]:bg-muted', props.class)">
    <slot />
  </tr>
</template>
