import { type ClassValue, clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export function truncateString(str: string, maxLength: number): string {
  if (str.length > maxLength)
    return `${str.slice(0, maxLength)}...`
  return str
}

export type Prettify<T> = {
  [K in keyof T]: T[K];
} & unknown
