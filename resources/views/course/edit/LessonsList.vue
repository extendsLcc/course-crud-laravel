<script setup lang="ts">
import { DragHandleDots2Icon } from '@radix-icons/vue'
import { VueDraggable } from 'vue-draggable-plus'
import { getEmbedVideoUrl } from '@/lib/embed-video-url'
import LessonDeleteActionButton from '@/views/course/edit/LessonDeleteActionButton.vue'
import LessonForm from '@/views/course/edit/LessonForm.vue'
import { Button } from '@/components/ui/button'
import { Tooltip, TooltipContent, TooltipTrigger } from '@/components/ui/tooltip'
import { cn } from '@/lib/utils'

const props = defineProps<{
  forModule: App.Data.ModuleData
}>()

const orderableLessons = ref(props.forModule.lessons)
const reorderLessonForm = useForm({
  method: 'PATCH',
  preserveScroll: true,
  url: route('courses.modules.lessons.reorder'),
  fields: {},
  transform() {
    return {
      lessonsOrder: orderableLessons.value.map(({ id }) => Number(id)),
    } satisfies App.Data.LessonOrderInputData
  },
})

// set orderableLessonsRef to props.forModule.lessons when it changes
watch(() => props.forModule.lessons, () => {
  orderableLessons.value = props.forModule.lessons
})
</script>

<template>
  <VueDraggable
    v-model="orderableLessons"
    v-auto-animate
    :class="cn(reorderLessonForm.processing && 'cursor-progress')"
    handle=".drag-handle"
    :animation="150"
    :disabled="reorderLessonForm.processing"
    @update="reorderLessonForm.submit"
  >
    <li
      v-for="lesson in orderableLessons" :key="lesson.id"
      class="flex flex-wrap items-center justify-center gap-2 p-2 hover:bg-accent/35 dark:hover:bg-accent/25 sm:flex-nowrap"
    >
      <span class="inline-flex h-48 w-52 shrink-0 items-center justify-center self-center">
        <iframe
          class="size-full"
          allowfullscreen
          :src="getEmbedVideoUrl(lesson.video_url)"
        />
      </span>
      <div class="flex flex-auto flex-col space-y-2">
        <span class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
          {{ lesson.title }}
        </span>
        <p class="line-clamp-2 overflow-hidden text-muted-foreground">
          {{ lesson.description }}
        </p>
      </div>
      <div class="inline-flex gap-1">
        <Tooltip>
          <TooltipTrigger as-child>
            <Button variant="ghost" class="drag-handle cursor-grab p-2 active:cursor-grabbing">
              <DragHandleDots2Icon class="size-5 " />
              <span class="sr-only">Drag to reorder lessons</span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>
            Drag to reorder lessons
          </TooltipContent>
        </Tooltip>

        <LessonForm :editing-lesson="lesson" />

        <LessonDeleteActionButton :for-lesson="lesson" />
      </div>
    </li>
  </VueDraggable>
</template>
