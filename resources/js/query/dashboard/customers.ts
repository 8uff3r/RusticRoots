import { User } from '@/types';
import { useQuery } from '@tanstack/vue-query';
import axios from 'axios';

async function fetchCustomers() {
  const { data } = await axios.get(route('users.indexCustomers'));
  return data;
}

export function useFetchCustomers(initialData: any) {
  return useQuery<User[]>({
    queryKey: ['DBCustomers'],
    queryFn: fetchCustomers,
    initialData
  });
}
