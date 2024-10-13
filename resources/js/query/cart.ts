import { useMutation, useQuery, useQueryClient } from '@tanstack/vue-query';
import axios from 'axios';

type Product = {
  name: string;
  price: number;
  offer_price: number;
  quantity?: number;
  id: number;
  imgs: string[];
};
async function addToCart(product: number, quantity: number) {
  return axios.post(route('cart.add', { product, _query: { quantity } }));
}

async function deleteCartItem(cartItem: number) {
  return axios.delete(route('cartItem.destroy', { cartItem }));
}

async function updateCartItemQuantity(cartItem: number, quantity: number) {
  return axios.put(route('cartItem.update', { cartItem, _query: { quantity } }));
}

async function fetchCartItems() {
  const { data } = await axios.get(route('cart.index'));
  return data.items;
}

export function useCartItems() {
  return useQuery<{ product: Product; quantity: number; id: number }[]>({
    queryKey: ['cartItems'],
    queryFn: fetchCartItems,
    staleTime: 1000 * 60 * 10
  });
}
export function useAddToCart() {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: ({ product, quantity }: { product: number; quantity: number }) => {
      return addToCart(product, quantity);
    },
    onSuccess: () => {
      // Invalidate cart items query to refetch the latest cart
      queryClient.invalidateQueries({ queryKey: ['cartItems'] });
    }
  });
}

export function useRmFromCart() {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (cartItem: number) => {
      return deleteCartItem(cartItem);
    },
    onSuccess: () => {
      // Invalidate cart items query to refetch the latest cart
      queryClient.invalidateQueries({ queryKey: ['cartItems'] });
    }
  });
}

export function useUpdateQuantity() {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: ({ cartItem, quantity }: { cartItem: number; quantity: number }) => {
      return updateCartItemQuantity(cartItem, quantity);
    },
    onSuccess: () => {
      // Invalidate cart items query to refetch the latest cart
      queryClient.invalidateQueries({ queryKey: ['cartItems'] });
    }
  });
}
