export type Gender = 'male' | 'female' | 'other'

export interface CreateUserDto {
  email: string
  password: string
  gender: Gender
}

export interface CreateUserResponse {
  user: {
    id: number
    email: string
    gender: Gender
    created_at: string
  }
  token: string
  token_type: string
}

export function validateCreateUserDto(dto: CreateUserDto): Record<string, string> {
  const errors: Record<string, string> = {}
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

  if (!dto.email) {
    errors.email = 'Email is required'
  } else if (!emailPattern.test(dto.email)) {
    errors.email = 'Enter a valid email'
  }

  if (!dto.password) {
    errors.password = 'Password is required'
  } else if (dto.password.length < 8) {
    errors.password = 'Password must be at least 8 characters'
  }

  if (!dto.gender) {
    errors.gender = 'Gender is required'
  }

  return errors
}
