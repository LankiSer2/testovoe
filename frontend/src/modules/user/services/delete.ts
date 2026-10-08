import apiClient from '@/shared/api/client'

export async function deleteProfile(): Promise<{ message: string }> {
  const { data } = await apiClient.delete<{ message: string }>('/api/profile')
  return data
}
