import apiClient from '@/shared/api/client'
import type { CreateUserDto, CreateUserResponse } from '../dto/create'

export async function createUser(payload: CreateUserDto): Promise<CreateUserResponse> {
  const { data } = await apiClient.post<CreateUserResponse>('/api/registration', payload)
  return data
}
