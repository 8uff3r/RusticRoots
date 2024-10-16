import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { useMutation, useQuery, useQueryClient } from '@tanstack/vue-query';
import { Product } from '@/types';

async function fetchProducts() {
  const { data } = await axios.get(route('product.index'));
  return data;
}

function addProduct(product: Partial<Product>) {
  return axios.get('');
}

function updateProduct(product: Product) {
  return axios.post(route('product.update', { product: product.id }), product);
}

export function useFetchProducts(initialData: any) {
  return useQuery({
    queryKey: ['DBProducts'],
    queryFn: fetchProducts,
    initialData
  });
}

export function useAddProduct() {
  return useMutation({
    mutationFn: (product: Product) => {
      return addProduct(product);
    },
    onSuccess: () => {
      fetchProducts();
    }
  });
}
export function useUpdateProduct() {
  const queryClient = useQueryClient();
  return useMutation({
    mutationFn: (product: Product) => {
      return updateProduct(product);
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['DBProducts'] });
    }
  });
}
