import apiClient from '@/shared/api/client'
import type { ProfileDto } from '../dto/read'

export async function readProfile(): Promise<ProfileDto> {
  const { data } = await apiClient.get<ProfileDto>('/api/profile')
  return data
}
