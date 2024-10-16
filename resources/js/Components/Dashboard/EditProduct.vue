<script setup lang="ts">
import { useUpdateProduct } from '@/query/dashboard/products';
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
import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput
} from '@/ShadComponents/ui/number-field';
import { Product } from '@/types';
import { Icon } from '@iconify/vue';
import { cloneDeep } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps<{
  mode: 'edit' | 'add';
  product?: Product;
  noTrigger?: boolean;
}>();
const qproduct = ref<Product>({
  name: '',
  id: 0,
  imgs: [],
  description: '',
  price: 0,
  offer_price: 0,
  stock: 0
});

const open = defineModel<boolean>('open');
const { mutate: update } = useUpdateProduct();
watch(
  () => props.product,
  (val) => {
    if (val) qproduct.value = cloneDeep(val);
  },
  { immediate: true }
);
const imgRef = ref<HTMLImageElement>();
const imgInput = ref<HTMLInputElement>();
function handleFiles(files: FileList | undefined | null) {
  if (files && imgRef.value && imgInput.value) {
    const file = files[0];
    if (!file.type.startsWith('image/')) {
      return;
    }
    // @ts-expect-error
    imgRef.value.file = file;

    const reader = new FileReader();
    reader.onloadend = () => {
      return;
    };
    reader.onload = (e) => {
      // @ts-expect-error
      imgRef.value.src = e.target?.result;
    };
    reader.readAsDataURL(file);

    const formData = new FormData();
    formData.append('file', file);
  }
}

const changeImage = (src: string) => {
  if (imgRef.value) imgRef.value.src = src;
};
const src = ref();
</script>

<template>
  <Dialog v-model:open="open">
    <DialogTrigger as-child v-if="!noTrigger">
      <Button>Add Product</Button>
    </DialogTrigger>
    <DialogContent class="mx-10 w-2/3 max-w-full">
      <DialogHeader>
        <DialogTitle>Add Product</DialogTitle>
        <DialogDescription>
          Make changes to the product here. Click save when you're done.
        </DialogDescription>
      </DialogHeader>

      <div class="flex w-full">
        <div class="grid h-96 w-full grid-rows-4 gap-2">
          <div class="relative row-span-3 w-full overflow-hidden rounded-md">
            <input
              id="pic"
              type="file"
              class="hidden"
              accept="image/jpeg, image/png, image/jpg"
              ref="imgInput"
              @change="handleFiles(($event.target as HTMLInputElement).files)"
            />
            <label for="pic" class="group absolute inset-0 cursor-pointer">
              <div
                class="absolute inset-0 z-20"
                @dragenter.prevent.stop
                @dragover.prevent.stop
                @drop.prevent.stop="handleFiles($event.dataTransfer?.files)"
              >
                <div
                  class="absolute flex h-full w-full place-items-center opacity-0 transition-opacity duration-300 ease-in-out group-hover:scale-105 group-hover:bg-slate-400 group-hover:opacity-50"
                >
                  <Icon icon="tabler:camera-plus" width="3rem" height="3rem" class="mx-auto" />
                </div>
              </div>
              <img
                alt=""
                class="h-full w-full border-none object-cover outline-none transition-transform group-hover:scale-105"
                ref="imgRef"
                :src="product?.imgs[0]"
              />
            </label>
          </div>

          <div class="flex justify-center gap-4 overflow-x-auto">
            <img
              v-for="(img, i) in product?.imgs"
              :key="i"
              :src="img"
              class="size-16 cursor-pointer rounded-md object-cover opacity-60 transition duration-300 hover:opacity-100 sm:size-20"
              @click="changeImage(img)"
            />
          </div>
        </div>
        <div class="flex w-full flex-col gap-4 px-4 py-4">
          <div class="grid grid-cols-4 items-center gap-4">
            <Label for="name" class="text-right"> Name </Label>
            <Input
              id="name"
              class="col-span-3"
              v-model="qproduct.name"
              @update:model-value="console.log"
            />
          </div>
          <div class="grid grid-cols-4 items-center gap-4">
            <Label for="description" class="text-right"> Description </Label>
            <Input id="description" class="col-span-3" v-model="qproduct.description" />
          </div>

          <div class="grid grid-cols-4 items-center gap-4">
            <Label class="text-right" for="age">Stock</Label>
            <NumberField
              id="age"
              :default-value="18"
              :min="0"
              class="col-span-3"
              v-model="qproduct.stock"
            >
              <NumberFieldContent>
                <NumberFieldDecrement />
                <NumberFieldInput />
                <NumberFieldIncrement />
              </NumberFieldContent>
            </NumberField>
          </div>
          <div class="grid grid-cols-4 items-center gap-4">
            <Label class="text-right" for="price">Price</Label>
            <Input type="number" id="price" class="col-span-3" v-model="qproduct.price" />
          </div>
          <div class="grid grid-cols-4 items-center gap-4">
            <Label class="text-right" for="offprice">Offer Price</Label>
            <Input type="number" id="offprice" class="col-span-3" v-model="qproduct.offer_price" />
          </div>

          <DialogFooter>
            <Button @click="() => update(qproduct as Product)"> Save changes </Button>
          </DialogFooter>
        </div>
      </div>
    </DialogContent>
  </Dialog>
</template>
