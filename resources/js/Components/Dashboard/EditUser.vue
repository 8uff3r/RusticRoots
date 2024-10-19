<script setup lang="ts">
import { User } from '@/types';

const props = defineProps<{
  mode: 'edit' | 'add';
  user?: User;
  noTrigger?: boolean;
}>();
</script>
<template>
  <div></div>
</template>
