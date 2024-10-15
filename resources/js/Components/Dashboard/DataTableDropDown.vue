<script setup lang="ts">
import { Button } from '@/ShadComponents/ui/button';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger
} from '@/ShadComponents/ui/dropdown-menu';
import { MoreHorizontal } from 'lucide-vue-next';
import { Product } from '@/types';

defineProps<{
  product: Product;
}>();

function copy(id: number | string) {
  navigator.clipboard.writeText(id.toString());
}
defineEmits(['edit']);
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="h-8 w-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="h-4 w-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel>Actions</DropdownMenuLabel>
      <DropdownMenuItem @click="copy(product.id)"> Copy product ID </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="$emit('edit', product)"> Edit Product </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
