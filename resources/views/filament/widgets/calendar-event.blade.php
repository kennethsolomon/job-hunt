<div class="flex flex-col items-start justify-start p-1 text-xs leading-tight">
    <!-- Event Title -->
    <div class="font-medium truncate max-w-full text-white" x-text="event.title"></div>

    <!-- Interview Details -->
    <template x-if="event.extendedProps.type === 'interview'">
        <div class="mt-1 space-y-1 w-full">
            <div class="flex items-center gap-1">
                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100"
                      x-text="event.extendedProps.interview_type?.replace('-', ' ') || 'Interview'"></span>
            </div>
            <div class="text-blue-100 text-xs" x-text="event.extendedProps.role" x-show="event.extendedProps.role"></div>
            <div class="text-blue-200 text-xs" x-text="event.extendedProps.location" x-show="event.extendedProps.location"></div>
        </div>
    </template>

    <!-- Task Details -->
    <template x-if="event.extendedProps.type === 'task'">
        <div class="mt-1 space-y-1 w-full">
            <div class="flex items-center gap-1">
                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium"
                      :class="event.extendedProps.is_overdue ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' : 'bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100'">
                    <span x-text="event.extendedProps.is_overdue ? 'Overdue' : 'Pending'"></span>
                </span>
            </div>
            <div class="text-amber-100 text-xs" x-text="event.extendedProps.company" x-show="event.extendedProps.company"></div>
        </div>
    </template>

    <!-- Follow-up Details -->
    <template x-if="event.extendedProps.type === 'followup'">
        <div class="mt-1 space-y-1 w-full">
            <div class="flex items-center gap-1">
                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100"
                      x-text="event.extendedProps.status || 'Follow-up'"></span>
            </div>
            <div class="text-green-100 text-xs" x-text="event.extendedProps.role" x-show="event.extendedProps.role"></div>
        </div>
    </template>
</div>