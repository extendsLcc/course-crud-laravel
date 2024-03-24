<script setup lang="ts">
import { ImageIcon, PlusIcon } from 'lucide-vue-next'
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
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Textarea } from '@/components/ui/textarea'
import { Separator } from '@/components/ui/separator'

const urlFragment = useUrlSearchParams<{ create?: string }>('hash-params', { write: false })
const isDialogOpen = ref('create' in urlFragment)
const courseForm = useForm<App.Data.CreateCourseInputData>({
  method: 'POST',
  url: route('courses.store'),
  fields: {
    name: '',
    description: '',
    cover_url: '',
  },
  hooks: {
    success: resetForm,
  },
})

function resetForm() {
  courseForm.clearErrors()
  courseForm.reset()
}
</script>

<template>
  <Dialog
    v-model:open="isDialogOpen"
    @update:open="(openState) => urlFragment.create = openState ? '' : undefined"
  >
    <DialogTrigger as-child>
      <Button size="sm" class="gap-1">
        New course
        <PlusIcon class="size-4" />
      </Button>
    </DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>New Course</DialogTitle>
        <DialogDescription>
          Fill in the form below to create a new course.
        </DialogDescription>
      </DialogHeader>
      <form class="space-y-4" @submit.prevent="courseForm.submit" @reset="resetForm">
        <div class="space-y-2">
          <Label html-for="name">Title</Label>
          <div class="space-y-1">
            <Input
              id="name"
              v-model="courseForm.fields.name"
              required
              :aria-invalid="courseForm.errors.name"
              aria-errormessage="name-error"
              placeholder="Enter course title"
            />
            <InputError
              v-if="courseForm.errors.name"
              id="name-error"
            >
              {{ courseForm.errors.name }}
            </InputError>
          </div>
        </div>
        <div class="space-y-2">
          <Label html-for="description">Description</Label>
          <div class="space-y-1">
            <Textarea
              id="description"
              v-model="courseForm.fields.description"
              type="text"
              required
              :aria-invalid="courseForm.errors.description"
              aria-errormessage="description-error"
              placeholder="Write a short description of the course"
            />
            <InputError
              v-if="courseForm.errors.description"
              id="description-error"
            >
              {{ courseForm.errors.description }}
            </InputError>
          </div>
        </div>

        <div class="flex flex-col space-y-2">
          <!-- TODO: change this to file upload -->
          <Label html-for="cover_url">Cover Image Url</Label>
          <div class="space-y-1">
            <Input
              id="cover_url"
              v-model="courseForm.fields.cover_url"
              type="text"
              required
              :aria-invalid="courseForm.errors.cover_url"
              aria-errormessage="cover_url-error"
              placeholder="Enter cover image url for the course"
            />
            <InputError
              v-if="courseForm.errors.cover_url"
              id="cover_url-error"
            >
              {{ courseForm.errors.cover_url }}
            </InputError>
          </div>

          <Avatar class="!mt-4 size-32 self-center shadow-lg" shape="square">
            <AvatarImage :src="courseForm.fields.cover_url" alt="cover image preview" />
            <AvatarFallback>
              <ImageIcon class="size-14 text-foreground/80" />
            </AvatarFallback>
          </Avatar>
        </div>
        <Separator />
        <DialogFooter class="gap-y-2">
          <Button type="reset" variant="destructive">
            Clear
          </Button>
          <SaveButton :is-saving="courseForm.processing" />
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
