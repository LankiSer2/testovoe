import { updateProfile } from '../services/update'
import type { UpdateUserDto } from '../dto/update'
import type { ProfileDto } from '../dto/read'

export async function updateProfileAction(dto: UpdateUserDto): Promise<ProfileDto> {
  return updateProfile(dto)
}
