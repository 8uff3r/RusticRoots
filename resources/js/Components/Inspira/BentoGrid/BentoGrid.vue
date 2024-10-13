<template>
  <div
    :class="
      cn(
        'mx-auto grid max-w-7xl grid-cols-1 gap-4 md:auto-rows-[18rem] md:grid-cols-3',
        $props.class
      )
    "
  >
    <slot />
  </div>
</template>

<script lang="ts" setup>
import { cn } from '@/lib/utils';

defineProps({
  class: String
});
</script>
