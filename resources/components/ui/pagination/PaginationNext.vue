<script setup lang="ts">
import { type HTMLAttributes, computed } from 'vue'
import { type PaginationFirstProps, PaginationNext } from 'radix-vue'
import { ChevronRight } from 'lucide-vue-next'
import {
  Button,
} from '@/components/ui/button'
import { cn } from '@/lib/utils'

const props = withDefaults(defineProps<
  PaginationFirstProps & {
    class?: HTMLAttributes['class']
    href?: string
    disabled?: boolean
  }
>(), {
  asChild: true,
})

const delegatedProps = computed(() => {
  const { class: _, href: _h, ...delegated } = props

  return delegated
})
</script>

<template>
  <router-link :href="props.href" :disabled="props.disabled" :aria-disabled="props.disabled">
    <PaginationNext v-bind="delegatedProps">
      <Button :class="cn('size-8 p-0', props.class)" variant="outline">
        <slot>
          <ChevronRight class="size-4" />
        </slot>
      </Button>
    </PaginationNext>
  </router-link>
</template>
