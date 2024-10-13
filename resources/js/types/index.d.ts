export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at?: string;
}

export interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
  stock: number;
  imgs: string[];
  offer_price: number;
}

export type PageProps<T extends Record = Record> = T & {
  auth: {
    user: User;
  };
};
