import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { useMutation, useQuery, useQueryClient } from '@tanstack/vue-query';
import { Product } from '@/types';

function fetchProducts() {
  router.visit(route('dashboard.products'), { only: ['products'] });
}

function addProduct(product: Partial<Product>) {
  return axios.get('');
}

function useAddProduct() {
  return useMutation({
    mutationFn: (product: Product) => {
      return addProduct(product);
    },
    onSuccess: () => {
      fetchProducts();
    }
  });
}
