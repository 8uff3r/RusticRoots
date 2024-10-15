<script setup lang="ts">
import { Button } from '@/ShadComponents/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger
} from '@/ShadComponents/ui/dialog';
import { Input } from '@/ShadComponents/ui/input';
import { Label } from '@/ShadComponents/ui/label';
import { Product } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  mode: 'edit' | 'add';
  product?: Product;
  noTrigger?: boolean;
}>();

const form = computed(() =>
  useForm(
    props.product ?? {
      name: '',
      description: '',
      price: 0,
      offer_price: 0,
      stock: 0
    }
  )
);
const open = defineModel<boolean>('open');
</script>

<template>
  <Dialog v-model:open="open">
    <DialogTrigger as-child v-if="!noTrigger">
      <Button>Add Product</Button>
    </DialogTrigger>
    <DialogContent class="sm:max-w-[425px]">
      <DialogHeader>
        <DialogTitle>Add Product</DialogTitle>
        <DialogDescription>
          Make changes to your profile here. Click save when you're done.
        </DialogDescription>
      </DialogHeader>
      <form @submit="form.post(route('product.update'))">
        <div class="grid gap-4 py-4">
          <div class="grid grid-cols-4 items-center gap-4">
            <Label for="name" class="text-right"> Name </Label>
            <Input id="name" class="col-span-3" v-model="form.name" />
          </div>
          <div class="grid grid-cols-4 items-center gap-4">
            <Label for="description" class="text-right"> Description </Label>
            <Input id="description" class="col-span-3" v-model="form.description" />
          </div>
        </div>
        <DialogFooter>
          <Button type="submit"> Save changes </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>
