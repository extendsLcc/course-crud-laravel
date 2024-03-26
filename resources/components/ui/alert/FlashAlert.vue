<script setup lang="ts">
import { CheckCircledIcon, CrossCircledIcon, ExclamationTriangleIcon, InfoCircledIcon } from '@radix-icons/vue'
import { XIcon } from 'lucide-vue-next'
import { Primitive } from 'radix-vue'
import type { FunctionalComponent } from 'vue'
import { TransitionRoot } from '@headlessui/vue'
import Alert from '@/components/ui/alert/Alert.vue'
import AlertTitle from '@/components/ui/alert/AlertTitle.vue'
import AlertDescription from '@/components/ui/alert/AlertDescription.vue'
import { Button } from '@/components/ui/button'

const flashMessage = useProperty('flash')

const flashMessageTypes = {
  success: {
    title: 'Success',
    icon: CheckCircledIcon,
  },
  error: {
    title: 'Error',
    icon: CrossCircledIcon,
  },
  warning: {
    title: 'Warning',
    icon: ExclamationTriangleIcon,
  },
  info: {
    title: 'Info',
    icon: InfoCircledIcon,
  },
} as const satisfies Record<keyof App.Data.FlashBagData, { title: string, icon: FunctionalComponent }>

const alert = computed(() => {
  if (flashMessage.value) {
    let flashType: keyof typeof flashMessageTypes
    for (flashType in flashMessageTypes) {
      if (flashMessage.value[flashType]) {
        return {
          flashType,
          title: flashMessageTypes[flashType].title,
          description: flashMessage.value[flashType],
          icon: flashMessageTypes[flashType].icon,
        }
      }
    }
  }
  return null
})

const isVisible = ref(alert.value !== null)
</script>

<template>
  <TransitionRoot
    v-if="alert"
    :show="alert && isVisible"
    enter="transition-opacity duration-75"
    enter-from="opacity-0"
    enter-to="opacity-100"
    leave="transition-opacity duration-300"
    leave-from="opacity-100"
    leave-to="opacity-0"
  >
    <Alert class="flex items-center gap-2 sm:gap-4" variant="success">
      <Primitive :as="alert.icon" class="relative size-5" />
      <div class="w-full">
        <AlertTitle>
          {{ alert.title }}
        </AlertTitle>
        <AlertDescription>
          {{ alert.description }}
        </AlertDescription>
      </div>
      <Button
        variant="ghost"
        class="size-10 rounded-full p-[unset] opacity-70 ring-offset-background transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none"
        @click="() => {
          alert && setProperty(`flash.${alert.flashType}`, null)
          isVisible = false
        }"
      >
        <XIcon class="size-4" />
        <span class="sr-only">Close</span>
      </Button>
    </Alert>
  </TransitionRoot>
</template>
