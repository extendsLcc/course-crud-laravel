<script setup lang="ts">
import { Loader2 } from 'lucide-vue-next'
import { useForwardProps } from 'radix-vue'
import type { ButtonProps } from '@/components/ui/button/Button.vue'
import Button from '@/components/ui/button/Button.vue'

const props = defineProps<ButtonProps & {
  isSaving: boolean
}>()

const forwardedProps = useForwardProps(props)
</script>

<template>
  <Button v-bind="forwardedProps" :disabled="props.isSaving" as-child>
    <button v-if="props.isSaving" class="flex">
      <Loader2 class="mr-2 size-4 animate-spin" />
      Saving...
    </button>
    <button v-else>
      Save
    </button>
  </Button>
</template>
