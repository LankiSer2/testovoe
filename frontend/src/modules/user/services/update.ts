import apiClient from '@/shared/api/client'
import type { ProfileDto } from '../dto/read'
import type { UpdateUserDto } from '../dto/update'

export async function updateProfile(payload: UpdateUserDto): Promise<ProfileDto> {
  const { data } = await apiClient.put<ProfileDto>('/api/profile', payload)
  return data
}
