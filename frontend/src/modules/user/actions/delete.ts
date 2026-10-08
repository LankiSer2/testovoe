import { deleteProfile } from '../services/delete'

export async function deleteProfileAction(): Promise<{ message: string }> {
  const result = await deleteProfile()
  localStorage.removeItem('auth_token')
  localStorage.removeItem('user_email')
  return result
}
