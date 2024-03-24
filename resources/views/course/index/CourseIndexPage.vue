<script setup lang="ts">
import { ImageIcon, PenIcon, TrashIcon } from 'lucide-vue-next'
import { RouterLink } from '@hybridly/vue'
import ContentShell from '@/layouts/ContentShell.vue'
import { Button, buttonVariants } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import Cross2Icon from '~icons/radix-icons/cross-2'
import ArrowDownIcon from '~icons/radix-icons/arrow-down'
import ArrowUpIcon from '~icons/radix-icons/arrow-up'
import CaretSortIcon from '~icons/radix-icons/caret-sort'
import EyeNoneIcon from '~icons/radix-icons/eye-none'
import MixerHorizontalIcon from '~icons/radix-icons/mixer-horizontal'
import {
  DropdownMenu,
  DropdownMenuCheckboxItem,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import {
  Pagination,
  PaginationEllipsis,
  PaginationFirst,
  PaginationItemLink,
  PaginationLast,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
} from '@/components/ui/pagination'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip'
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
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import NewCourseForm from '@/views/course/index/NewCourseForm.vue'

const props = defineProps<{
  courses: Table<App.Data.CourseTableOutputData>
}>()

useHead({
  title: 'Courses List',
  meta: [{
    name: 'description',
    content: 'List of courses available in the system.',
  }],
})

const coursesTableData = useTable(props, 'courses')
const queryParams = useQueryParameters<{
  limit: string | null
  page: string | null
  search: string | null
  sort: string | null
}>()
const hiddenColumns = ref(new Set<string>())
const searchInput = ref(coursesTableData.getFilter('search')?.value ?? '')
const searchInputDebounced = refDebounced(searchInput, 250)

watch(searchInputDebounced, () => {
  coursesTableData.applyFilter('search', searchInputDebounced.value, {
    transformUrl: { query: { page: undefined } },
  })
})

const urlWithSearchParams = computed(() => {
  return (newQueryParams: Partial<typeof queryParams>) => {
    return { ...queryParams, ...newQueryParams }
  }
})

function clearTableFilters() {
  coursesTableData.clearFilters()
  searchInput.value = ''
}
</script>

<template layout="panel-shell">
  <ContentShell
    title="Courses" :breadcrumb="{
      currentPage: 'Courses',
      items: [],
    }"
  >
    <template #head-actions>
      <NewCourseForm />
    </template>

    <!--    <FlashAlert /> -->

    <div class="space-y-4 pt-4">
      <!-- DataTable Toolbar -->
      <div class="flex flex-wrap items-center justify-between gap-2">
        <!-- DataTable Filters -->
        <div class="min-w flex flex-[1_1_20rem] flex-wrap items-center gap-y-2 space-x-2">
          <Input
            v-model="searchInput"
            placeholder="Filter courses..."
            class="h-8 w-full min-w-[85px] sm:w-[150px] lg:w-[250px]"
          />

          <Button
            v-if="coursesTableData.isFiltering()"
            variant="ghost"
            class="h-8 px-2 lg:px-3"
            @click="clearTableFilters"
          >
            Reset
            <Cross2Icon class="ml-2 size-4" />
          </Button>
        </div>
        <!-- /DataTable Filters -->

        <!-- DataTable Column Visibility -->
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button
              variant="outline"
              size="sm"
              class="flex h-8 "
            >
              <MixerHorizontalIcon class="mr-2 size-4" />
              View
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end" class="w-[150px]">
            <DropdownMenuLabel>Toggle columns</DropdownMenuLabel>
            <DropdownMenuSeparator />

            <DropdownMenuCheckboxItem
              v-for="column in [...coursesTableData.columns, { name: 'actions', label: 'Actions' }]"
              :key="column.name"
              class="capitalize"
              :checked="!hiddenColumns.has(column.name)"
              @update:checked="(isChecked) => {
                if (!isChecked) hiddenColumns.add(column.name)
                else hiddenColumns.delete(column.name)
              }"
              @select.prevent
            >
              {{ column.label }}
            </DropdownMenuCheckboxItem>
          </DropdownMenuContent>
        </DropdownMenu>
        <!-- /DataTable Column Visibility -->
      </div>
      <!-- /DataTable Toolbar -->

      <!-- DataTable -->
      <div class="rounded-md border">
        <TooltipProvider :delay-duration="250">
          <Table>
            <TableHeader>
              <TableRow>
                <template v-for="column in coursesTableData.columns" :key="column.name">
                  <TableHead v-if="!hiddenColumns.has(column.name)">
                    <!-- DataTable SortableColumns -->
                    <DropdownMenu v-if="column.isSortable">
                      <DropdownMenuTrigger as-child>
                        <Button
                          variant="ghost"
                          size="sm"
                          class="-ml-3 h-8 data-[state=open]:bg-accent"
                        >
                          <span>{{ column.label }}</span>
                          <ArrowDownIcon v-if="column.isSortable.isSorting('desc')" class="ml-2 size-4" />
                          <ArrowUpIcon v-else-if="column.isSortable.isSorting('asc')" class="ml-2 size-4" />
                          <CaretSortIcon v-else class="ml-2 size-4" />
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="start">
                        <DropdownMenuItem
                          @click="() => {
                            if (column.isSortable?.isSorting('asc')) column.isSortable?.clear()
                            else column.isSortable?.toggle({ direction: 'asc' })
                          }"
                        >
                          <ArrowUpIcon class="mr-2 size-3.5 text-muted-foreground/70" />
                          Asc
                        </DropdownMenuItem>
                        <DropdownMenuItem
                          @click="() => {
                            if (column.isSortable?.isSorting('desc')) column.isSortable?.clear()
                            else column.isSortable?.toggle({ direction: 'desc' })
                          }"
                        >
                          <ArrowDownIcon class="mr-2 size-3.5 text-muted-foreground/70" />
                          Desc
                        </DropdownMenuItem>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem @click="hiddenColumns.add(column.name)">
                          <EyeNoneIcon class="mr-2 size-3.5 text-muted-foreground/70" />
                          Hide
                        </DropdownMenuItem>
                      </DropdownMenuContent>
                    </DropdownMenu>
                    <!-- /DataTable SortableColumns -->
                    <template v-else>
                      {{ column.label }}
                    </template>
                  </TableHead>
                </template>
                <TableHead v-if="!hiddenColumns.has('actions')">
                  Actions
                </TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              <template v-if="coursesTableData.records.length">
                <TableRow
                  v-for="courseRow in coursesTableData.records"
                  :key="courseRow.key"
                >
                  <TableCell v-if="!hiddenColumns.has('id')" class="text-left">
                    {{ courseRow.record.id }}
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('cover_url')">
                    <RouterLink :href="route('courses.edit', { course: courseRow.record.id })">
                      <Avatar class="size-32" shape="square">
                        <AvatarImage :src="courseRow.record.cover_url" alt="cover image preview" />
                        <AvatarFallback>
                          <ImageIcon class="size-14 text-foreground/80" />
                        </AvatarFallback>
                      </Avatar>
                    </RouterLink>
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('name')">
                    {{ courseRow.record.name }}
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('description')">
                    {{ courseRow.record.description }}
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('modules_count')" class="text-center">
                    {{ courseRow.record.modules_count }}
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('lessons_count')" class="text-center">
                    {{ courseRow.record.lessons_count }}
                  </TableCell>
                  <TableCell v-if="!hiddenColumns.has('actions')">
                    <!-- Row Actions -->
                    <div class="flex flex-nowrap">
                      <!-- Edit Button -->
                      <Tooltip>
                        <TooltipTrigger as-child>
                          <Button
                            variant="ghost"
                            class="flex size-8 p-0 data-[state=open]:bg-muted"
                            :as="RouterLink"
                            :href="route('courses.edit', { course: courseRow.record.id })"
                          >
                            <PenIcon class="size-4" />
                            <span class="sr-only fixed">Edit Course {{ courseRow.record.name }}</span>
                          </Button>
                        </TooltipTrigger>
                        <TooltipContent>
                          Edit Course
                        </TooltipContent>
                      </Tooltip>
                      <!-- /Edit Button -->
                      <!-- Delete Button -->
                      <AlertDialog>
                        <AlertDialogTrigger>
                          <Tooltip>
                            <TooltipTrigger as-child>
                              <Button
                                variant="ghost"
                                class="flex size-8 p-0 data-[state=open]:bg-muted"
                              >
                                <TrashIcon class="size-4" />
                                <span class="sr-only fixed">Delete Course</span>
                              </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                              Delete Course
                            </TooltipContent>
                          </Tooltip>
                        </AlertDialogTrigger>
                        <AlertDialogContent>
                          <AlertDialogHeader>
                            <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                            <AlertDialogDescription>
                              This action delete the course and all its modules and lessons.
                            </AlertDialogDescription>
                          </AlertDialogHeader>
                          <AlertDialogFooter>
                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                            <AlertDialogAction
                              :class="buttonVariants({ variant: 'destructive' })"
                              @click.stop="() => courseRow.execute('delete')"
                            >
                              Continue
                            </AlertDialogAction>
                          </AlertDialogFooter>
                        </AlertDialogContent>
                      </AlertDialog>
                      <!-- /Delete Button -->
                    </div>
                    <!-- /Row Actions -->
                  </TableCell>
                </TableRow>
              </template>

              <TableRow v-else>
                <TableCell
                  :colspan="coursesTableData.columns.length"
                  class="h-24 text-center"
                >
                  No results.
                </TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </TooltipProvider>
      </div>
      <!-- /DataTable -->

      <!-- DataTable Pagination Controls -->
      <div class="flex items-center justify-between px-2">
        <div class="flex-1 text-sm text-muted-foreground">
          {{ coursesTableData.records.length }} of
          {{ coursesTableData.paginator.meta.total }} row(s).
        </div>
        <section class="flex flex-wrap items-center gap-y-2 space-x-6 lg:space-x-8">
          <div class="flex items-center space-x-2">
            <p class="text-sm font-medium">
              Rows per page
            </p>
            <Select
              @update:model-value="(perPage) => {
                router.reload({
                  transformUrl: {
                    query: {
                      limit: perPage === '10' ? undefined : perPage,
                      page: undefined,
                    },
                  } })
              }"
            >
              <SelectTrigger class="h-8 w-[70px]">
                <SelectValue :placeholder="queryParams.limit ?? '10'" />
              </SelectTrigger>
              <SelectContent side="top">
                <SelectItem v-for="pageSize in [2, 5, 10, 20, 30, 40, 50]" :key="pageSize" :value="`${pageSize}`">
                  {{ pageSize }}
                </SelectItem>
              </SelectContent>
            </Select>
          </div>
          <div class="flex w-[100px] items-center justify-center text-sm font-medium">
            Page {{ coursesTableData.paginator.meta.current_page }} of
            {{ coursesTableData.paginator.meta.last_page }}
          </div>
          <Pagination
            v-slot="{ page }"
            :key="coursesTableData.paginator.meta.current_page"
            :total="coursesTableData.paginator.meta.total"
            :sibling-count="1"
            show-edges
            :default-page="coursesTableData.paginator.meta.current_page"
            :items-per-page="coursesTableData.paginator.meta.per_page"
          >
            <PaginationList v-slot="{ items }" class="flex flex-wrap items-center gap-1">
              <PaginationFirst
                :href="coursesTableData.paginator.meta.first_page_url"
                :disabled="!coursesTableData.paginator.meta.prev_page_url"
              />
              <PaginationPrev
                :href="coursesTableData.paginator.meta.prev_page_url"
                :disabled="!coursesTableData.paginator.meta.prev_page_url"
              />

              <template v-for="(item, index) in items">
                <PaginationListItem
                  v-if="item.type === 'page'"
                  :key="JSON.stringify(urlWithSearchParams({ page: `${item.value}` }))"
                  :value="item.value"
                  as-child
                >
                  <PaginationItemLink
                    :href="route('courses.index', urlWithSearchParams({ page: `${item.value}` }))"
                    :active="item.value === page"
                  >
                    {{ item.value }}
                  </PaginationItemLink>
                </PaginationListItem>
                <PaginationEllipsis v-else :key="item.type" :index="index" />
              </template>

              <PaginationNext
                :href="coursesTableData.paginator.meta.next_page_url"
                :disabled="!coursesTableData.paginator.meta.next_page_url"
              />
              <PaginationLast
                :href="coursesTableData.paginator.meta.last_page_url"
                :disabled="!coursesTableData.paginator.meta.next_page_url"
              />
            </PaginationList>
          </Pagination>
        </section>
      </div>
      <!-- /DataTable Pagination Controls -->
    </div>
  </ContentShell>
</template>
