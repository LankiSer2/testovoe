import { readProfile } from '../services/read'
import type { ProfileDto } from '../dto/read'

export async function getProfileAction(): Promise<ProfileDto> {
  const profile = await readProfile()

  console.log('[profile request]', {
    method: 'GET',
    url: '/api/profile',
  })
  console.log('[profile response]', profile)

  return profile
}
