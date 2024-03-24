<script setup lang="ts">
import { Button } from '@/components/ui/button'

const props = defineProps<{
  href: string
  active: boolean
}>()
</script>

<template>
  <router-link
    preload="hover"
    preserve-scroll
    :href="props.href"
    :disabled="props.active"
  >
    <Button class="size-8 p-0" :variant="props.active ? 'default' : 'outline'">
      <slot />
    </Button>
  </router-link>
</template>
