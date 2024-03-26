<script setup lang="ts">
import { PenIcon, PlusIcon } from 'lucide-vue-next'
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

const props = defineProps<{
  forCourse: App.Data.EditCourseOutputData
  editingModule?: App.Data.ModuleData
}>()
const isDialogOpen = ref(false)
const moduleForm = useForm<App.Data.CreateModuleInputData>({
  method: props.editingModule ? 'PUT' : 'POST',
  preserveScroll: true,
  updateInitials: Boolean(props.editingModule),
  url: props.editingModule
    ? route('courses.modules.update', { module: props.editingModule.id })
    : route('courses.modules.store', { course: props.forCourse.id }),
  fields: {
    title: props.editingModule ? props.editingModule.title : '',
  },
  hooks: {
    success: () => {
      resetForm()
      isDialogOpen.value = false
    },
  },
})

function resetForm() {
  moduleForm.clearErrors()
  moduleForm.reset()
}
</script>

<template>
  <Dialog v-model:open="isDialogOpen">
    <Tooltip v-if="editingModule">
      <DialogTrigger as-child>
        <TooltipTrigger as-child>
          <Button
            variant="ghost"
            class="p-2"
          >
            <PenIcon class="size-5 " />
            <span class="sr-only">Edit Module title</span>
          </Button>
        </TooltipTrigger>
        <TooltipContent>
          Edit Module title
        </TooltipContent>
      </DialogTrigger>
    </Tooltip>
    <DialogTrigger v-else as-child>
      <Button size="sm" class="gap-1">
        New Module
        <PlusIcon class="size-4" />
      </Button>
    </DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>
          {{ props.editingModule ? 'Edit' : 'New' }} Module
        </DialogTitle>
        <DialogDescription>
          {{ props.editingModule
            ? 'Update the form below to edit the module.'
            : 'Fill in the form below to create a new module.' }}
        </DialogDescription>
      </DialogHeader>
      <form class="space-y-4" @submit.prevent="moduleForm.submit" @reset.prevent="resetForm">
        <div class="space-y-2">
          <Label html-for="module-title">Title</Label>
          <div class="space-y-1">
            <Input
              id="module-title"
              v-model="moduleForm.fields.title"
              required
              :aria-invalid="moduleForm.errors.title"
              aria-errormessage="module-title-error"
              placeholder="Enter module title"
            />
            <InputError
              v-if="moduleForm.errors.title"
              id="module-title-error"
            >
              {{ moduleForm.errors.title }}
            </InputError>
          </div>
        </div>
        <Separator />
        <DialogFooter class="gap-y-2">
          <Button type="reset" variant="destructive">
            Clear
          </Button>
          <SaveButton :is-saving="moduleForm.processing" />
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
