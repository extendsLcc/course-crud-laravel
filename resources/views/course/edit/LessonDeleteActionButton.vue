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
  forLesson: App.Data.LessonData
}>()

function handleDeleteConfirmation() {
  router.delete(
    route('courses.modules.lessons.delete', { lesson: props.forLesson }),
    { preserveScroll: true },
  )
}
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
            <span class="sr-only">Delete lesson</span>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          Delete Lesson
        </TooltipContent>
      </AlertDialogTrigger>
    </Tooltip>
    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>
          Are you sure you want to delete lesson "{{
            props.forLesson.title
          }}"?
        </AlertDialogTitle>
        <AlertDialogDescription>
          This action delete the lesson {{ props.forLesson.title }}.
        </AlertDialogDescription>
      </AlertDialogHeader>
      <AlertDialogFooter>
        <AlertDialogCancel>Cancel</AlertDialogCancel>
        <AlertDialogAction
          :class="buttonVariants({ variant: 'destructive' })"
          @click.stop="handleDeleteConfirmation"
        >
          Confirm
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
