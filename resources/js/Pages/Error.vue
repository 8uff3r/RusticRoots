<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
  status: number;
  message: string;
}>();
</script>
<template>
  <AuthenticatedLayout>
    <div
      class="flex min-h-screen flex-col items-center justify-center bg-white px-4 dark:bg-slate-950 sm:px-6 lg:px-8"
    >
      <div class="w-full max-w-md space-y-8 text-center">
        <div class="mb-8">
          <h2 class="mt-6 text-6xl font-extrabold text-gray-900 dark:text-gray-100">
            {{ status }}
          </h2>
          <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ message }}</p>
          <!-- <p class="mt-2 text-sm text-gray-600 dark:text-gray-400"> -->
          <!--   {{ message }} -->
          <!-- </p> -->
        </div>
        <div class="mt-8">
          <Link
            href="/"
            class="inline-flex items-center rounded-md border border-transparent bg-amber-600 px-4 py-2 text-base font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
          >
            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12h18m-9-9l9 9-9 9"
              />
            </svg>
            Go back home
          </Link>
        </div>
      </div>
      <div class="mt-16 w-full max-w-2xl">
        <div class="relative">
          <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-slate-300 dark:border-slate-600"></div>
          </div>
          <div class="relative flex justify-center">
            <span
              class="bg-slate-200 px-2 text-sm text-slate-500 dark:bg-slate-800 dark:text-slate-400"
            >
              If you think this is a mistake, please contact support
            </span>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
