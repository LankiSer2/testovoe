import type { Gender } from './create'

export interface ProfileDto {
  id: number
  email: string
  gender: Gender
  created_at: string
}
