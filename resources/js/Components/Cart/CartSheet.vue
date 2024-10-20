<script setup lang="ts">
import { useAddToCart, useCartItems, useRmFromCart, useUpdateQuantity } from '@/query/cart';
import { Button } from '@/ShadComponents/ui/button';
import { Label } from '@/ShadComponents/ui/label';
import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput
} from '@/ShadComponents/ui/number-field';
import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetDescription,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger
} from '@/ShadComponents/ui/sheet';
import { Icon } from '@iconify/vue';
import { useDebounceFn } from '@vueuse/core';

const { data: cartItems } = useCartItems();
const { mutate: addToCart } = useAddToCart();
const { mutate: rmFromCart } = useRmFromCart();
const { mutate: updateQuantity } = useUpdateQuantity();

const debouncedUpdate = useDebounceFn(
  (id: any, quantity: number) => updateQuantity({ cartItem: id, quantity }),
  1000
);
</script>

<template>
  <Sheet>
    <SheetTrigger as-child>
      <Button variant="outline" class="relative">
        <Icon icon="f7:cart" width="1.2rem" height="1.2rem" />
        <span
          v-show="cartItems?.length ?? 0 > 0"
          class="absolute -top-1 left-[70%] flex h-4 min-w-[16px] items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-semibold text-white"
        >
          {{ cartItems?.length }}
        </span>
      </Button>
    </SheetTrigger>
    <SheetContent class="overflow-auto">
      <SheetHeader>
        <SheetTitle>Your Cart</SheetTitle>
        <SheetDescription>
          <span v-if="cartItems?.length ?? 0 > 0">
            You can change your cart or proceed to checkout
          </span>
          <span v-else> Cart is empty </span>
        </SheetDescription>
      </SheetHeader>
      <div class="mt-12 space-y-4" v-for="(p, i) in cartItems" :key="i">
        <div class="grid grid-cols-3 items-start gap-4">
          <div class="flex items-start gap-4">
            <div class="h-28 w-28 shrink-0 rounded-md bg-gray-100 p-2 max-sm:h-24 max-sm:w-24">
              <img :src="p.product.imgs?.[0]" class="h-full w-full object-contain" />
            </div>
          </div>
          <div class="flex h-full flex-col justify-between">
            <h3 class="text-base font-bold text-gray-800 max-sm:text-sm">{{ p.product.name }}</h3>

            <Button
              type="button"
              variant="destructive"
              class="flex shrink-0 items-center gap-1 text-xs font-semibold"
              @click="rmFromCart(p.id)"
            >
              <Icon icon="tabler:trash" width="1.2rem" height="1.2rem" />
              REMOVE
            </Button>
          </div>

          <div class="ml-auto flex h-full flex-col justify-between">
            <h4 class="text-lg font-bold text-gray-800 max-sm:text-base">
              ${{
                (!p.product.offer_price ? p.product.price : p.product.offer_price).toLocaleString()
              }}
            </h4>
            <NumberField
              :defaultValue="p.quantity ?? 1"
              :min="1"
              @update:model-value="(v) => debouncedUpdate(p.id, v)"
            >
              <Label>Quantity</Label>
              <NumberFieldContent>
                <NumberFieldDecrement />
                <NumberFieldInput />
                <NumberFieldIncrement />
              </NumberFieldContent>
            </NumberField>
          </div>
        </div>

        <hr class="border-gray-300" />
      </div>
      <SheetFooter>
        <button
          type="button"
          class="mt-6 w-full rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold tracking-wide text-white hover:bg-blue-700"
        >
          Make Payment
        </button>
      </SheetFooter>
    </SheetContent>
  </Sheet>
</template>
