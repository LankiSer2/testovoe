import { createUser } from '../services/create'
import type { CreateUserDto, CreateUserResponse } from '../dto/create'
import { validateCreateUserDto } from '../dto/create'

export async function registerUserAction(dto: CreateUserDto): Promise<CreateUserResponse> {
  const errors = validateCreateUserDto(dto)
  if (Object.keys(errors).length > 0) {
    throw { validation: errors }
  }

  const response = await createUser(dto)

  console.log('[registration request]', {
    method: 'POST',
    url: '/api/registration',
    body: { email: dto.email, password: '***', gender: dto.gender },
  })
  console.log('[registration response]', response)

  localStorage.setItem('auth_token', response.token)
  localStorage.setItem('user_email', response.user.email)

  return response
}
