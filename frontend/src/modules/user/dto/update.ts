import type { Gender } from './create'

export interface UpdateUserDto {
  email?: string
  password?: string
  gender?: Gender
}
