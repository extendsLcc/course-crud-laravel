<script setup lang="ts">
import { type HTMLAttributes, computed } from 'vue'
import { AlertDialogAction, type AlertDialogActionProps } from 'radix-vue'
import { Loader2 } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import { Button, buttonVariants } from '@/components/ui/button'
import { useNavigationEvent } from '@/composables/useNavigationEvent'

const props = defineProps<AlertDialogActionProps & { class?: HTMLAttributes['class'] }>()

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})

// TODO: only closes the dialog after the navigation is complete
const onNavigate = useNavigationEvent()
</script>

<template>
  <AlertDialogAction v-bind="delegatedProps" as-child>
    <Button :class="cn(buttonVariants(), props.class)" :disabled="onNavigate.isNavigating">
      <Loader2 v-if="onNavigate.isNavigating" class="mr-2 size-4 animate-spin" />
      <slot />
    </Button>
  </AlertDialogAction>
</template>
