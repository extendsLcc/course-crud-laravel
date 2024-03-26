<script setup lang="ts">
import { TrashIcon } from 'lucide-vue-next'
import { Button, buttonVariants } from '@/components/ui/button'
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/components/ui/alert-dialog'
import { Tooltip, TooltipContent, TooltipTrigger } from '@/components/ui/tooltip'

const props = defineProps<{
  forModule: App.Data.ModuleData
}>()
</script>

<template>
  <AlertDialog>
    <Tooltip>
      <AlertDialogTrigger as-child>
        <TooltipTrigger as-child>
          <Button
            variant="ghost"
            class="p-2"
            type="button"
          >
            <TrashIcon class="size-5 " />
            <span class="sr-only">Delete module and it's lessons</span>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          Delete Module
        </TooltipContent>
      </AlertDialogTrigger>
    </Tooltip>
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>Are you sure you want to delete module "{{ props.forModule.title }}"?</AlertDialogTitle>
        <AlertDialogDescription>
          This action delete the module {{ props.forModule.title }} and all its lessons.
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel>Cancel</AlertDialogCancel>
        <AlertDialogAction
          :class="buttonVariants({ variant: 'destructive' })"
          @click.stop="router.delete(route('courses.modules.destroy', { module: props.forModule }), {
            preserveScroll: true,
          })"
        >
          Confirm
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
