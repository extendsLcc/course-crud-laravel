<script setup lang="ts">
import { CirclePlusIcon, PenIcon } from 'lucide-vue-next'
import { Button, SaveButton } from '@/components/ui/button'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { InputError } from '@/components/ui/input-error'
import { Separator } from '@/components/ui/separator'
import { Tooltip, TooltipContent, TooltipTrigger } from '@/components/ui/tooltip'
import {
  AlertDialog,
} from '@/components/ui/alert-dialog'
import { Textarea } from '@/components/ui/textarea'
import { checkIfValidYoutubeOrVimeoUrl, getEmbedVideoUrl } from '@/lib/embed-video-url'

const props = defineProps<{
  forModule?: App.Data.ModuleData
  editingLesson?: App.Data.LessonData
}>()
const isDialogOpen = ref(false)
const lessonForm = useForm<App.Data.CreateLessonInputData>({
  method: props.editingLesson ? 'PUT' : 'POST',
  preserveScroll: true,
  updateInitials: Boolean(props.editingLesson),
  url: props.editingLesson
    ? route('courses.modules.lessons.update', { lesson: props.editingLesson })
    : route('courses.modules.lessons.store', { module: props.forModule }),
  fields: {
    title: props.editingLesson ? props.editingLesson.title : '',
    description: props.editingLesson ? props.editingLesson.description : '',
    video_url: props.editingLesson ? props.editingLesson.video_url : '',
  },
  hooks: {
    success: () => {
      resetForm()
      isDialogOpen.value = false
    },
  },
})

watchEffect(() => {
  if (lessonForm.fields.video_url && !checkIfValidYoutubeOrVimeoUrl(lessonForm.fields.video_url)) {
    lessonForm.setErrors({
      video_url: 'Please enter a valid YouTube or Vimeo video URL',
    })
    return
  }
  lessonForm.clearErrors('video_url')
})

function resetForm() {
  lessonForm.clearErrors()
  lessonForm.reset()
}
</script>

<template>
  <AlertDialog>
    <Dialog v-model:open="isDialogOpen">
      <Tooltip>
        <DialogTrigger as-child>
          <TooltipTrigger as-child>
            <Button
              variant="ghost"
              class="p-2"
              type="button"
            >
              <PenIcon v-if="editingLesson" class="size-5 " />
              <CirclePlusIcon v-else class="size-5" />
              <span class="sr-only">
                {{ props.editingLesson
                  ? 'Edit Lesson'
                  : 'Add new lesson for this module' }}
              </span>
            </Button>
          </TooltipTrigger>
          <TooltipContent>
            {{ props.editingLesson
              ? 'Edit Lesson'
              : 'Add new lesson for this module' }}
          </TooltipContent>
        </DialogTrigger>
      </Tooltip>

      <DialogContent>
        <DialogHeader>
          <DialogTitle>
            {{ props.editingLesson ? 'Edit' : 'New' }} Lesson
          </DialogTitle>
          <DialogDescription>
            {{ props.editingLesson
              ? 'Update the form below to edit the lesson.'
              : 'Fill in the form below to create a new lesson.' }}
          </DialogDescription>
        </DialogHeader>
        <form class="space-y-4" @submit.prevent="lessonForm.submit" @reset.prevent="resetForm">
          <div class="space-y-2">
            <Label html-for="lesson-title">Title</Label>
            <div class="space-y-1">
              <Input
                id="lesson-title"
                v-model="lessonForm.fields.title"
                required
                :aria-invalid="lessonForm.errors.title"
                aria-errormessage="lesson-title-error"
                placeholder="Enter lesson title"
              />
              <InputError
                v-if="lessonForm.errors.title"
                id="lesson-title-error"
              >
                {{ lessonForm.errors.title }}
              </InputError>
            </div>
          </div>
          <div class="space-y-2">
            <Label html-for="lesson-description">Description</Label>
            <div class="space-y-1">
              <Textarea
                id="lesson-description"
                v-model="lessonForm.fields.description"
                type="text"
                required
                :aria-invalid="lessonForm.errors.description"
                aria-errormessage="lesson-description-error"
                placeholder="Write a short description of this lesson"
              />
              <InputError
                v-if="lessonForm.errors.description"
                id="lesson-description-error"
              >
                {{ lessonForm.errors.description }}
              </InputError>
            </div>
          </div>
          <div class="flex flex-col items-center justify-center gap-4">
            <div class="flex w-full flex-auto flex-col space-y-2">
              <Label html-for="lesson-video_url">Video Url</Label>
              <div class="space-y-1">
                <Input
                  id="lesson-video_url"
                  v-model="lessonForm.fields.video_url"
                  :default-value="lessonForm.fields.video_url"
                  type="text"
                  required
                  :aria-invalid="lessonForm.errors.video_url"
                  aria-errormessage="lesson-video_url-error"
                  placeholder="Enter video url for this lesson"
                  class="min-w-32"
                />
                <InputError
                  v-if="lessonForm.errors.video_url"
                  id="lesson-video_url-error"
                >
                  {{ lessonForm.errors.video_url }}
                </InputError>
              </div>
            </div>

            <span class="inline-flex h-48 w-52 shrink-0 items-center justify-center self-center">
              <iframe
                v-if="checkIfValidYoutubeOrVimeoUrl(lessonForm.fields.video_url)"
                class="size-full"
                allowfullscreen
                :src="getEmbedVideoUrl(lessonForm.fields.video_url)"
              />
            </span>
          </div>
          <Separator />
          <DialogFooter class="gap-y-2">
            <Button type="reset" variant="destructive">
              Clear
            </Button>
            <SaveButton :is-saving="lessonForm.processing" />
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  </alertdialog>
</template>
